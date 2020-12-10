<?php
// Tabel Master
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = DB::table('publishers')->get();
        return view('publishers.index', ['publishers' => $publishers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publishers.create');
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
            'name' => 'required|unique:publishers'
        ]);
        $data = [
            'name' => $request->name,
            'created_at' => date('Y-m-d H:i:s')
        ];
        DB::table('publishers')->insert($data);
        return redirect('/publishers')->with('flash', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data Berhasil Ditambahkan!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $publisher = DB::table('publishers')
            ->where('id', '=', $id)
            ->first();
        return view('publishers.edit', ['publishers' => $publisher]);
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
            'name' => 'required|unique:publishers'
        ]);
        $data = [
            'name' => $request->name,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        DB::table('publishers')
            ->where('id', '=', $request->id)
            ->update($data);
        return redirect('/publishers')->with('flash', [
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
        $check = DB::table('publications')
            ->where('book_id', '=', $id)
            ->count();
        if ($check > 0) {
            return redirect('/publishers')->with('flash', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Data tidak dapat dihapus'
            ]);
        }
        DB::table('publishers')
            ->where('id', '=', $id)
            ->delete();
        return redirect('/publishers')->with('flash', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data Berhasil Dihapus!'
        ]);
    }
}
