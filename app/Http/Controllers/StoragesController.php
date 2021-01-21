<?php
// Tabel Relasi Antara buku dan rak
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoragesController extends Controller
{
    public static function _insert($book_id, $bookshelf_id)
    {
        DB::table('storages')->insert([
            'book_id' => $book_id,
            'bookshelfs_id' => $bookshelf_id,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
    public static function _update($book_id, $bookshelf_id)
    {
        DB::table('storages')
            ->where('book_id', $book_id)
            ->update([
                'bookshelfs_id' => $bookshelf_id,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
    }
}
