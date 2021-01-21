<?php
// Tabel relasi antara buku dan penerbit
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicationsController extends Controller
{
    public static function _insert($book_id, $publisher_id, $year)
    {
        DB::table('publications')->insert([
            'book_id' => $book_id,
            'publisher_id' => $publisher_id,
            'year' => $year,
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
    public static function _update($book_id, $publisher_id, $year)
    {
        DB::table('publications')
            ->where('book_id', $book_id)
            ->update([
                'publisher_id' => $publisher_id,
                'year' => $year,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
    }
}
