<?php
// Table relasi Antara buku dan penulis

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreationsController extends Controller
{
    public static function _insert($book_id, $writer_id)
    {
        DB::table('creations')->insert([
            'book_id' => $book_id,
            'writer_id' => $writer_id,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
    public static function _update($book_id, $writer_id)
    {
        DB::table('creations')
            ->where('book_id', $book_id)
            ->update([
                'writer_id' => $writer_id,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
    }
}
