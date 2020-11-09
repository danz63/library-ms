<?php

namespace App\Http\Controllers;

use \App\Http\Controllers\PhonesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
            ->select('users.*', 'access.level')
            ->leftJoin('access', 'users.access_id', '=', 'access.id')->get();
        Request()->session()->flash('origin', 'index');
        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $access = DB::table('access')->get();
        return view('users.create', ['access' => $access]);
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
            'username' => 'required|unique:users',
            'password' => 'required',
            'fullname' => 'required',
            'address' => 'required',
            'access_id' => 'required',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $file = $request->file('image');
        $file_name = time() . "_" . $request->username . "." . $file->getClientOriginalExtension();
        $upload_path = "img/upload";
        $file->move($upload_path, $file_name);
        $data = [
            'username' => $request->username,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'name' => $request->fullname,
            'address' => $request->address,
            'image' => $file_name,
            'access_id' => $request->access_id,
            'created_at' => date('Y-m-d H:i:s')
        ];
        DB::table('users')->insert($data);
        return redirect('/users')->with('flash', [
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
        $user = DB::table('users')
            ->select('users.*', 'access.level')
            ->leftJoin('access', 'users.access_id', '=', 'access.id')
            ->where('users.id', '=', $id)->first();
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('users')
            ->where('id', '=', $id)
            ->first();
        if (session('access_id') == '1')
            $access = DB::table('access')->get();
        else
            $access = DB::table('access')->where('id', '=', 2)->get();
        return view('users.edit', ['user' => $user, 'access' => $access]);
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
            'image' => 'file|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $data = [
            'name' => $request->fullname,
            'address' => $request->address,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        if (session('access_id') == '1') {
            $data += ['access_id' => $request->access_id];
        } else {
            $data += ['access_id' => 2];
        }
        if ($request->password) {
            $data += ['password' => password_hash($request->password, PASSWORD_DEFAULT)];
        }
        $user_data = DB::table('users')->where('username', '=', $request->username)->first();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $upload_path = "img/upload";
            $image_old = public_path($upload_path . "/" . $user_data->image);
            if (file_exists($image_old)) {
                unlink($image_old);
                $file_name = time() . "_" . $request->username . "." . $file->getClientOriginalExtension();
                $file->move($upload_path, $file_name);
                $data += ['image' => $file_name];
            }
        }
        DB::table('users')->where('username', '=', $request->username)->update($data);
        $url = $request->origin == 'index' ? '/users' : '/user/detail';
        return redirect($url)->with('flash', [
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
    public function destroy(Request $request)
    {
        DB::table('users')->delete($request->id);
        return redirect('/users')->with('flash', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Data Berhasil Dihapus!'
        ]);
    }

    public function detail()
    {
        $user = DB::table('users')
            ->select('users.*', 'access.level')
            ->leftJoin('access', 'users.access_id', '=', 'access.id')
            ->where('users.id', '=', session()->get('user_id'))
            ->first();
        $phones = PhonesController::getNumber(session()->get('user_id'));
        Request()->session()->flash('origin', 'detail');
        return view('users.detail', ['user' => $user, 'phones' => $phones]);
    }
}
