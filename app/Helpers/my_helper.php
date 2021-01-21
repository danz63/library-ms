<?php

use Illuminate\Support\Facades\DB;

function getAuthorOfBook($id)
{
    $writer = DB::table('creations')
        ->select('creations.*', 'writers.id as writer_id', 'writers.name')
        ->join('writers', 'creations.writer_id', '=', 'writers.id')
        ->where('creations.book_id', '=', $id)
        ->first();
    return $writer;
}

function getCategoriesOfBooks($id)
{
    $tags = DB::table('tags')
        ->leftjoin('categories', 'tags.category_id', '=', 'categories.id')
        ->where('tags.book_id', '=', $id)
        ->get();
    return $tags;
}

function getPublisherOfBooks($id)
{
    $publishers = DB::table('publications')
        ->select('publications.*', 'publishers.id as publisher_id', 'publishers.name')
        ->leftjoin('publishers', 'publications.publisher_id', '=', 'publishers.id')
        ->where('publications.book_id', '=', $id)
        ->first();
    return $publishers;
}

function getStoragesOfBook($id)
{
    $bookshelf = DB::table('storages')
        ->select('bookshelfs.name')
        ->leftjoin('bookshelfs', 'storages.bookshelfs_id', '=', 'bookshelfs.id')
        ->where('storages.book_id', '=', $id)
        ->first();
    return $bookshelf->name;
}

function _isLoggedIn()
{
    if (session('status') == 'login') {
        return true;
    }
    return false;
}
function _isAdmin()
{
    if (_isLoggedIn())
        if (session('access_id') == '1') {
            return true;
        }
    return false;
}

function _isMember()
{
    if (_isLoggedIn())
        if (session('access_id') == '2') {
            return true;
        }
    return false;
}

function getWishList($user_id)
{
    $borrow = DB::table('borrows')
        ->select('id')
        ->where([
            ['user_id', $user_id],
            ['status',  0]
        ])
        ->first();
    $borrow_id = $borrow ? $borrow->id : false;
    $response = DB::table('detail_borrows')
        ->select('detail_borrows.id as db_id',  'books.*')
        ->join('books', 'detail_borrows.book_id', '=', 'books.id')
        ->where('detail_borrows.borrow_id', '=', $borrow_id)
        ->get();
    return $response;
}

function getNotifications()
{
    if (_isMember()) {
        $borrows = DB::table('borrows')
            ->select('id', 'status')
            ->where('user_id', '=',  session('user_id'))
            ->whereBetween('status', [1, 4])
            ->first();
        if ($borrows === null) {
            return [
                'message' => "Tidak Ada Notifikasi",
                'detail_message' => "Tidak Ada Notifikasi",
                'detail' => []
            ];
        }
        switch ($borrows->status) {
            case 1:
                $message = "Pengajuan Peminjaman";
                $detail_message = "Menunggu Konfirmasi Admin";
                break;
            case 2:
                $message = "Terkonfirmasi";
                $detail_message = "Buku Sudah Dikonfirmasi Admin";
                break;
            case 3:
                $message = "Masa Peminjaman";
                $detail_message = "Buku Sedang Anda Pinjam";
                break;
            case 4:
                $message = "Hampir Habis";
                $detail_message = "Masa Peminjaman Habis atau Akan Habis";
                break;
            default:
                $message = "";
                $detail_message = "";
                break;
        }
        $detail = DB::table('detail_borrows')
            ->where('borrow_id', $borrows->id)
            ->get();
        $ret = [
            'message' => $message,
            'detail_message' => $detail_message,
            'detail' => $detail
        ];
        return $ret;
    }

    if (_isAdmin()) {
        $detail = DB::table('borrows')
            ->select(DB::raw("COUNT(*) as jum"), DB::raw("CASE WHEN status=1 THEN 'Anggota Menunggu Konfirmasi' WHEN status=4 THEN 'Masa Peminjaman Habis' END as status_borrow"))
            ->whereIn('status', [1, 4])
            ->groupBy('status')
            ->get();
        $ret = [
            'message' => "Notifikasi",
            'detail' => $detail
        ];
        return $ret;
    }
    // SELECT COUNT(*), CASE WHEN status=1 THEN 'Applied' WHEN status=2 THEN 'Confirmed' WHEN status=3 THEN 'Loaned' WHEN status=4 THEN 'Expired' WHEN status=5 THEN 'Returned' END as status FROM borrows GROUP BY status 
}

function getUserById($id)
{
    return DB::table('users')->where('id', $id)->first();
}

function parsingDate($date)
{
    $time = strtotime($date);
    return getDayName(date('l', $time)) . ", " . date('d', $time) . " " . getMonthName(date('m', $time)) . " " . date('Y', $time) . ", " . date("H:i", $time);
}

function getDayName($day)
{
    switch ($day) {
        case 'Sunday':
            return 'Minggu';
        case 'Monday':
            return 'Senin';
        case 'Tuesday':
            return 'Selasa';
        case 'Wednesday':
            return 'Rabu';
        case 'Thursday':
            return 'Kamis';
        case 'Friday':
            return 'Jumat';
        case 'Saturday':
            return 'Sabtu';
        default:
            return 'hari tidak valid';
    }
}

function getMonthName($month)
{
    switch ($month) {
        case '01':
            return 'Januari';
        case '02':
            return 'Februari';
        case '03':
            return 'Maret';
        case '04':
            return 'April';
        case '05':
            return 'Mei';
        case '06':
            return 'Juni';
        case '07':
            return 'Juli';
        case '08':
            return 'Agustus';
        case '09':
            return 'September';
        case '10':
            return 'Oktober';
        case '11':
            return 'November';
        case '12':
            return 'Desember';
        default:
            return 'Bulan tidak valid';
    }
}

function nextAction($list)
{
    $actions = ['wishlist', 'applied', 'confirmed', 'loaned', 'expired', 'returned'];
    $nextAction = array_search($list, $actions);
    return $actions[++$nextAction];
}

function LoanStatus($status = 0, $exp = false)
{
    $response = new stdClass();
    switch ($status) {
        case 1:
            $response->button = true;
            $response->color = 'yellow-300';
            $response->information = 'Sedang Diajukan';
            $response->explanation = 'Peminjaman ini sedang Ajukan, Mohon Tunggu Konfirmasi Admin';
            break;
        case 2:
            $response->button = false;
            $response->color = 'blue-200';
            $response->information = 'Terkonfirmasi';
            $response->explanation = 'Peminjaman ini telah dikonfirmasi admin, silahkan datang untuk mengambilnya';
            break;

        case 3:
            $response->button = false;
            $color = strtotime($exp . '+ 7 days') < time() ? 'red-200' : 'blue-200';
            $info = strtotime($exp . '+ 7 days') < time() ? 'Sudah Berakhir' : 'Sedang dipinjam';
            $explan = strtotime($exp . '+ 7 days') < time() ? 'Peminjaman ini telah habis, berakhir pada ' . parsingDate(date('Y-m-d', strtotime($exp . '+ 7 days'))) : 'Peminjaman ini sedang berlangsung, Pastikan kembalikan sebelum ' . parsingDate(date('Y-m-d', strtotime($exp . '+ 7 days')));
            $response->color = $color;
            $response->information = $info;
            $response->explanation = $explan;
            break;
        case 4:
            $response->button = false;
            $response->color = 'blue-200';
            $response->information = 'Dikembalikan';
            $response->explanation = 'Buku-buku sudah dikembalikan';
            break;

        default:
            $response->button = true;
            $response->color = 'gray-300';
            $response->information = 'Belum Diajukan';
            $response->explanation = 'Peminjaman ini belum Anda Ajukan, Silahkan Ajukan dengan klik ikon <i class="fa fa-fw fa-list-alt"></i> diatas dan klik Tombol \'Ajukan Peminjaman\'';
            break;
    }
    return $response;
}
