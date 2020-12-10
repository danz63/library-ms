<?php
// Table Master
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccessController extends Controller
{
    public function index()
    {
        $access = DB::table('access')->get();
        return view('access.index', ['access' => $access]);
    }


    public function edit($id)
    {
        $access = DB::table('access')->where('id', '=', $id)->first();
        return view('access.edit', ['access' => $access]);
    }

    public function update(Request $request)
    {
        DB::table('access')->where('id', '=', $request->id)->update([
            'level' => $request->level,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return redirect('/access')->with('flash', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data Berhasil Diubah!'
        ]);
    }
}
