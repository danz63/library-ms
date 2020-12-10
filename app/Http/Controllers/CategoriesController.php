<?php
// Tabel Master
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')->get();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'name' => 'required|unique:categories'
        ]);
        $data = [
            'name' => $request->name,
            'created_at' => date('Y-m-d H:i:s')
        ];
        DB::table('categories')->insert($data);
        return redirect('/categories')->with('flash', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data Berhasil Ditambahkan!'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = DB::table('categories')->where('id', '=', $id)->first();
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);
        $data = [
            'name' => $request->name,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        DB::table('categories')
            ->where('id', '=', $request->id)
            ->update($data);
        return redirect('/categories')->with('flash', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data Berhasil Diperbaharui!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = DB::table('tags')
            ->where('book_id', '=', $id)
            ->count();
        if ($check > 0) {
            return redirect('/categories')->with('flash', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Data tidak dapat dihapus'
            ]);
        }
        DB::table('categories')
            ->where('id', '=', $id)
            ->delete();
        return redirect('/categories')->with('flash', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data Berhasil Dihapus!'
        ]);
    }
}
