<?php
// tabel relasi antara kategori dan buku
// Diasumsikan 1 buku bisa bermacam2 kategori
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
    public static function _insert($book_id, $categories)
    {
        $data = [];
        foreach ($categories as $cat) {
            $data[] = [
                'book_id' => $book_id,
                'category_id' => $cat,
                'created_at' => date("Y-m-d H:i:s")
            ];
        }
        DB::table('tags')->insert($data);
    }
    public static function _update($book_id, $categories)
    {
        DB::table('tags')->where('book_id', $book_id)->delete();
        $data = [];
        foreach ($categories as $cat) {
            $data[] = [
                'book_id' => $book_id,
                'category_id' => $cat,
                'created_at' => date("Y-m-d H:i:s")
            ];
        }
        DB::table('tags')->insert($data);
    }
}
