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
        $query = false;
        if ($request->get('query')) {
            $books = DB::table('books')->where('title', 'like', "%" . $request->get('query') . "%")->get();
            $query = $request->get('query');
        } else {
            $books = DB::table('books')->get();
        }
        $data = [
            'books' => $books,
            'query' => $query
        ];
        return view('pages.catalogs', $data);
    }

    public function transactions()
    {
    }
}
