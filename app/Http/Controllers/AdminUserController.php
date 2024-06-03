<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Halaman User
        $data = [
            'title' => 'Manajemen User',
            'user'  => User::paginate(10),
            'content' => 'admin.user.index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Halaman Tambah di  User
        $data = [
            'content' => 'admin.user.create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Submit
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            're_password' => 'required|same:password',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);
        Alert::success('Sukses', 'Data Berhasil Ditambahkan');
        return redirect('/admin/user')->with('success', 'Data Berhasil Ditambahkan
        ');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Halaman Edit User

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Halam Edit
        $data = [
            'user' => User::find($id),
            'content' => 'admin.user.create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //Fungsi Update
        $user = User::find($id);
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'  . $user->id,
            // 'password' => 'required',
            're_password' => 'same:password',
        ]);

        if ($request -> password != '') {
            $data['password'] = Hash::make($request->password);
        }else {
            $data['password'] = $user->password;
        }

        $user -> update($data);
        Alert::success('Sukses', 'Data Berhasil Diedit');
        return redirect('/admin/user')->with('success', 'Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        $user -> delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/admin/user')->with('success', 'Data Berhasil Dihapus');
    }
}
