<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookshelfsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookshelfs = DB::table('bookshelfs')->get();
        return view('bookshelfs/index', ['bookshelfs' => $bookshelfs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bookshelfs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:bookshelfs'
        ]);
        DB::table('bookshelfs')->insert([
            'name' => $request->name,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return redirect('/bookshelfs')->with('flash', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data Berhasil Ditambahkan!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bookshelfs  $bookshelfs
     * @return \Illuminate\Http\Response
     */
    public function listOfBooks($id)
    {
    }
}
