<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WritersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $writers = DB::table('writers')->get();
        return view('writers.index', ['writers' => $writers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('writers.create');
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
            'name' => 'required|unique:writers'
        ]);
        $data = [
            'name' => $request->name,
            'created_at' => date('Y-m-d H:i:s')
        ];
        DB::table('writers')->insert($data);
        return redirect('/writers')->with('flash', [
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
        $writers = DB::table('writers')
            ->where('id', '=', $id)
            ->first();
        return view('writers.edit', ['writers' => $writers]);
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
            'name' => 'required|unique:writers'
        ]);
        $data = [
            'name' => $request->name,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        DB::table('writers')
            ->where('id', '=', $request->id)
            ->update($data);
        return redirect('/writers')->with('flash', [
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
        $check = DB::table('creations')
            ->where('writer_id', '=', $id)
            ->count();
        if ($check > 0) {
            return redirect('/writers')->with('flash', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Data Tidak Dapat Dihapus!'
            ]);
        }
        DB::table('writers')->delete($id);
        return redirect('/writers')->with('flash', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data Berhasil Dihapus!'
        ]);
    }
}
