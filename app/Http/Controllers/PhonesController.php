<?php
// Table extend dari table user
// Diasumsikan 1 User bisa lebih dari 1 nomor telepon
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhonesController extends Controller
{
    public static function getNumber($id)
    {
        $number = DB::table('phones')
            ->select('id', 'member_id', 'number')
            ->where('member_id', '=', $id)
            ->get();
        return $number;
    }

    public function store(Request $request)
    {
        $request->number = str_replace(' ', '', $request->number);
        if (preg_match('/[^0-9]/', $request->number)) {
            $res = [
                'status' => false,
                'message' => 'Nomor Telepon Harus berupa nomor (0-9)'
            ];
        } else {
            $data = [
                'member_id' => session()->get('user_id'),
                'number' => $request->number,
                'created_at' => date('Y-m-d H:i:s')
            ];
            DB::table('phones')->insert($data);
            $res = [
                'status' => true,
                'message' => 'Nomor Berhasil Ditambahkan'
            ];
            $request->session()->flash('flash', [
                'icon' => 'success',
                'title' => 'Success',
                'text' => 'Nomor Berhasil Ditambahkan!'
            ]);
        }
        return response()->json($res);
    }
    public function destroy(Request $request)
    {
        DB::table('phones')->delete($request->id);
        $request->session()->flash('flash', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Nomor Berhasil Dihapus!'
        ]);
        return response()->json(['status' => true]);
    }
}
