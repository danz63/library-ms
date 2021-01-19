<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function register()
    {
        return view('pages.register');
    }

    public function do_login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = DB::table('users')->where('username', $request->username)->first();
        if (!$user) {
            // username not valid;
            $data = [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'username tidak ditemukan'
            ];
            return redirect('/')->with('flash', $data)->withInput();
        } else {
            // username valid
            if (!password_verify($request->password, $user->password)) {
                // password not valid
                $data = [
                    'icon' => 'error',
                    'title' => 'Error',
                    'text' => 'password tidak valid'
                ];
                return redirect('/')->with('flash', $data)->withInput();
            } else {
                // all data valid
                $data = [
                    'status' => 'login',
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'name' => $user->name,
                    'access_id' => $user->access_id
                ];
                session($data);
                return redirect('/')->with('flash', [
                    'icon' => 'success',
                    'title' => 'Success',
                    'text' => 'Login Berhasil!'
                ]);
            }
        }
    }

    public function do_register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users',
            'password' => 'required',
            'fullname' => 'required',
            'address' => 'required',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $file = $request->file('image');
        $file_name = time() . "_" . $file->getClientOriginalName();
        $upload_path = "img/upload";
        $file->move($upload_path, $file_name);
        $data = [
            'username' => $request->username,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'name' => $request->fullname,
            'address' => $request->address,
            'image' => $file_name,
            'access_id' => 2,
            'created_at' => date('Y-m-d H:i:s')
        ];
        DB::table('users')->insert($data);
        return redirect('/')->with('flash', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Registrasi Berhasil! Silahkan Login'
        ]);
    }

    public function do_logout()
    {
        session()->flush();
        return redirect('/')->with('flash', [
            'icon' => 'info',
            'title' => 'Success',
            'text' => 'Logout Berhasil! Silahkan Datang Kembali'
        ]);
    }

    public function books(Request $request)
    {
        $message = false;
        if ($request->get('query')) {
            $books = DB::table('books')->where('title', 'like', "%" . $request->get('query') . "%")->get();
            $message = "Hasil Pencarian '" . $request->get('query') . "'";
        } elseif ($request->get('category')) {
            $books = DB::table('tags')
                ->select("tags.*", "books.*", "categories.name as category_name")
                ->rightJoin('books', 'tags.book_id', '=', 'books.id')
                ->join('categories', 'tags.category_id', '=', 'categories.id')
                ->where('tags.category_id', '=', $request->get('category'))
                ->where('books.status', 1)
                ->get();
            if (count($books) > 0) {
                $message = "Buku Dengan Kategori '" . $books[0]->category_name . "'";
            }
        } elseif ($request->get('writer')) {
            $books = DB::table('creations')
                ->select("creations.*", "books.*", "writers.name as writer_name")
                ->rightJoin('books', 'creations.book_id', '=', 'books.id')
                ->join('writers', 'creations.writer_id', '=', 'writers.id')
                ->where('creations.writer_id', '=', $request->get('writer'))
                ->where('books.status', 1)
                ->get();
            if (count($books) > 0) {
                $message = "Buku Karangan '" . $books[0]->writer_name . "'";
            }
        } elseif ($request->get('publisher')) {
            $books = DB::table('publications')
                ->select("publications.*", "books.*", "publishers.name as publisher_name")
                ->rightJoin('books', 'publications.book_id', '=', 'books.id')
                ->join('publishers', 'publications.publisher_id', '=', 'publishers.id')
                ->where('publications.publisher_id', '=', $request->get('publisher'))
                ->where('books.status', 1)
                ->get();
            if (count($books) > 0) {
                $message = "Buku Cetakan '" . $books[0]->publisher_name . "'";
            }
        } elseif ($request->get('bookshelf')) {
            $books = DB::table('storages')
                ->select("storages.*", "books.*", "bookshelfs.name as bookshelf_name")
                ->rightJoin('books', 'storages.book_id', '=', 'books.id')
                ->join('bookshelfs', 'storages.bookshelfs_id', '=', 'bookshelfs.id')
                ->where('storages.bookshelfs_id', '=', $request->get('bookshelf'))
                ->where('books.status', 1)
                ->get();
            if (count($books) > 0) {
                $message = "Buku Cetakan '" . $books[0]->bookshelf_name . "'";
            }
        } else {
            $books = DB::table('books')->where('books.status', 1)->get();
        }

        $data = [
            'books' => $books,
            'message' => $message
        ];
        return view('pages.catalogs', $data);
    }

    public static function _forbiden()
    {
        return view('template/403');
    }

    public static function _faq()
    {
        return view('template/faq');
    }
}
