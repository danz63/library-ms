<?php
// Table Master

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\StoragesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\PublicationsController;
use App\Http\Controllers\CreationsController;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = DB::table('books')->get();
        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = $this->getAllOptions();
        $options = json_decode($options);
        return view('books/create', ['options' => $options]);
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
            'title' => 'required|unique:books',
            'writers' => 'required',
            'publishers' => 'required',
            'year' => 'required',
            'bookshelfs' => 'required',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $file = $request->file('image');
        $splt = explode('.', $file->getClientOriginalName());
        $file_name = time() . "." . $splt[count($splt) - 1];
        $upload_path = "img/books";
        $file->move($upload_path, $file_name);
        $data = [
            'title' => $request->title,
            'images' => $file_name,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $LastID = DB::table('books')->insertGetId($data);
        StoragesController::_insert($LastID, $request->bookshelfs);
        CreationsController::_insert($LastID, $request->writers);
        PublicationsController::_insert($LastID, $request->publishers, $request->year);
        TagsController::_insert($LastID, $request->categories);
        return redirect('/books')->with('flash', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data Berhasil Ditambahkan!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Books  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Books  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Books  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Books  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAllOptions()
    {
        $res = [
            'bookshelfs' => DB::table('bookshelfs')->get(),
            'publishers' => DB::table('publishers')->get(),
            'writers' => DB::table('writers')->get(),
            'categories' => DB::table('categories')->get()
        ];
        return json_encode($res);
    }
}
