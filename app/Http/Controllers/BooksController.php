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
        $books = DB::table('books')->where('status', 1)->get();
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
            'title' => 'required',
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
            'status' => 1,
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
        $book = DB::table('books')->where('id', $id)->first();
        $options = $this->getAllOptions();
        $options = json_decode($options);
        return view('books/edit', ['options' => $options, 'book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Books  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'writers' => 'required',
            'publishers' => 'required',
            'year' => 'required',
            'bookshelfs' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $splt = explode('.', $file->getClientOriginalName());
            $file_name = time() . "." . $splt[count($splt) - 1];
            $upload_path = "img/books";
            $file->move($upload_path, $file_name);
            unlink(public_path($upload_path) . '/' . $request->oldimage);
        } else {
            $file_name = $request->oldimage;
        }
        $data = [
            'title' => $request->title,
            'status' => 1,
            'images' => $file_name,
            'created_at' => date('Y-m-d H:i:s')
        ];
        DB::table('books')
            ->where('id', $request->id)
            ->update($data);
        StoragesController::_update($request->id, $request->bookshelfs);
        CreationsController::_update($request->id, $request->writers);
        PublicationsController::_update($request->id, $request->publishers, $request->year);
        TagsController::_update($request->id, $request->categories);
        return redirect('/books')->with('flash', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data Berhasil Diperbaharui!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Books  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('books')
            ->where('id', $id)
            ->update(['status' => 0]);
        return redirect('/books')->with('flash', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data Berhasil Dihapus!'
        ]);
    }

    public function getAllOptions()
    {
        $res = [
            'bookshelfs' => DB::table('bookshelfs')->orderBy('name')->get(),
            'publishers' => DB::table('publishers')->orderBy('name')->get(),
            'writers' => DB::table('writers')->orderBy('name')->get(),
            'categories' => DB::table('categories')->orderBy('name')->get()
        ];
        return json_encode($res);
    }
}
