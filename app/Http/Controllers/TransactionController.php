<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index($list = 'wishlist')
    {
        if (!_isAdmin()) {
            return redirect('forbiden');
        }
        $data = $this->data($list);
        return view('transactions.index', $data);
    }

    public function addWishList(Request $request)
    {
        $isBorrowing = DB::table('borrows')
            ->where('user_id', session('user_id'))
            ->whereBetween('status', [1, 3])
            ->doesntExist();
        if (!$isBorrowing) {
            $res = [
                'icon' => 'warning',
                'title' => 'Maaf',
                'text' => 'Anda Masih dalam masa peminjaman atau pengajuan pinjaman'
            ];
            return json_encode($res);
        }
        $isExist = DB::table('borrows')
            ->where([
                ['user_id', $request->user_id],
                ['status', 0]
            ]);
        if ($isExist->doesntExist()) {
            $data = [
                'user_id' => $request->user_id,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $borrow_id = DB::table('borrows')->insertGetId($data);
        } else {
            $borrow_id = $isExist->first()->id;
            $detail_borrows = DB::table('detail_borrows')
                ->where('borrow_id', $borrow_id);
            if ($detail_borrows->count() >= 2) {
                $res = [
                    'icon' => 'warning',
                    'title' => 'Maaf',
                    'text' => 'Peminjaman buku melebihi batas'
                ];
                return json_encode($res);
            }
            $arr_book_id = $detail_borrows->pluck('book_id')->toArray();
            if (in_array($request->book_id, $arr_book_id)) {
                $res = [
                    'icon' => 'warning',
                    'title' => 'Maaf',
                    'text' => 'Buku Sudah Ada dalam wishlist'
                ];
                return json_encode($res);
            }
        }
        $data = [
            'borrow_id' => $borrow_id,
            'book_id' => $request->book_id,
            'created_at' => date('Y-m-d H:i:s')
        ];
        DB::table('detail_borrows')->insert($data);
        $res = [
            'icon' => 'success',
            'title' => 'Sukses',
            'text' => 'Buku Sukses Ditambahkan dalam Keranjang Wishlist'
        ];
        return json_encode($res);
    }

    public function removeWishList($id)
    {
        DB::table('detail_borrows')->delete($id);
    }

    public function ApplyLoan()
    {
        DB::table('borrows')
            ->where([
                ['user_id', session('user_id')],
                ['status', 0]
            ])
            ->update(['status' => 1]);
        return redirect('/')->with('flash', [
            'icon' => 'info',
            'title' => 'Success',
            'text' => 'Sedang diajukan, tunggu konfirmasi admin'
        ]);
    }

    public function data($list)
    {
        $actions = ['wishlist', 'applied', 'confirmed', 'loaned', 'returned'];
        $param = array_search($list, $actions);
        $borrows = DB::table('borrows')
            ->select('borrows.*', 'users.name')
            ->join('users', 'borrows.user_id', 'users.id')
            ->where('status', $param)
            ->get();
        if ($list == 'expired') {
            $borrows = DB::table('borrows')
                ->select('borrows.*', 'users.name')
                ->join('users', 'borrows.user_id', 'users.id')
                ->whereRaw('TIMESTAMPDIFF(DAY, borrows.updated_at, CURRENT_TIMESTAMP) > 5')
                ->get();
        }
        if ($list == 'loaned') {
            $borrows = DB::table('borrows')
                ->select('borrows.*', 'users.name')
                ->join('users', 'borrows.user_id', 'users.id')
                ->where('status', $param)
                ->whereRaw('TIMESTAMPDIFF(DAY, borrows.updated_at, CURRENT_TIMESTAMP) <= 5')
                ->get();
        }
        $relation = DB::table('detail_borrows')
            ->select('detail_borrows.borrow_id', DB::raw('GROUP_CONCAT(books.title SEPARATOR \'; \n\') as books'))
            ->join('books', 'detail_borrows.book_id', '=', 'books.id')
            ->groupBy('detail_borrows.borrow_id')
            ->pluck('books', 'detail_borrows.borrow_id');
        $data = [
            'borrows' => $borrows,
            'relation' => $relation,
            'active_tab' => $list
        ];
        return $data;
    }

    public function history()
    {
        $query = DB::table('borrows')
            ->where('user_id', session('user_id'));
        $borrows = $query->get();
        $arr_b_id = $query->pluck('id')->toArray();
        $d_borrows = DB::table('detail_borrows')
            ->leftJoin('books', 'detail_borrows.book_id', 'books.id')
            ->whereIn('borrow_id', $arr_b_id)
            ->get();
        $data = [
            'borrows' => $borrows,
            'detail' => $d_borrows
        ];
        return view('transactions.user_index', $data);
    }

    public function response($list, $borrow_id)
    {
        switch ($list) {
            case 'confirmed':
                $param = ['status' => 2];
                $text = 'Sukses Dikonfirmasi, Notifikasi diberikan akan diberikan kepada member terkait';
                break;
            case 'loaned':
                $param = ['status' => 3, 'updated_at' => date('Y-m-d H:i:s')];
                $text = 'Sukses Dikonfirmasi, Estimasi pengembalian buku adalah ' . date('d-m-Y', strtotime('+ 7 days'));
                break;

            case 'returned':
                $param = ['status' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => null];
                $text = 'Pengembalian dikonfirmasi';
                break;

            default:
                return redirect('/')->with('flash', [
                    'icon' => 'danger',
                    'title' => 'Peringatan',
                    'text' => 'URL tidak sesuai'
                ]);
                break;
        }
        DB::table('borrows')
            ->where('id', $borrow_id)
            ->update($param);
        $actions = ['wishlist', 'applied', 'confirmed', 'loaned', 'returned'];
        $param = array_search($list, $actions);
        return redirect('/transaction/list/' . $actions[$param])->with('flash', [
            'icon' => 'success',
            'title' => 'Sukes',
            'text' => $text
        ]);
    }
}
/*
    Status Table Peminjaman
    default peberian pada method addWishList()
    0 => 'belum diajukan peminjaman oleh member'
    Diubah oleh method ApplyLoan()
    1 => 'sudah diajukan peminjaman oleh member, belum dikonfirmasi admin'
    
    di proses oleh function response
    2 => 'sudah dikonfirmasi admin (buku fisik belu diambil)'
    3 => 'buku sudah diambil (masa peminjaman)'
    4 => 'buku sudah dikembalikan'
*/