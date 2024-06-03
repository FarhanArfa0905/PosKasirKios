<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\produk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Halaman Kategori
        $data = [
            'produk' => produk::paginate(10),
            'title' =>'Manajemen Produk',
            'content' => 'admin.produk.index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Halaman Tambah produk
        $data = [
            'title' =>'Tambah produk',
            'kategori' => Kategori::get(),
            'content' => 'admin.produk.create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $file_name = time() . "_" . $gambar->getClientOriginalName();

            $storage =  'uploads/images/';
            $gambar->move($storage, $file_name);
            $data['gambar'] = $storage . $file_name;
        } else {
            $data['gambar'] = null;
        }

        produk::create($data);
        Alert::success('Sukses', 'Data Berhasil Ditambahkan');
        return redirect('/admin/produk');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = [
            'title' =>'Tambah produk',
            'kategori' => Kategori::get(),
            'produk' => produk::find($id),
            'content' => 'admin.produk.create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Halaman Update
        $produk = produk::find($id);
        $data = $request->validate([
            'name' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $file_name = time() . "_" . $gambar->getClientOriginalName();

            $storage =  'uploads/images/';
            $gambar->move($storage, $file_name);
            $data['gambar'] = $storage . $file_name;
        } else {
            $data['gambar'] = $produk->gambar;
        }

        $produk->update($data);
        Alert::success('Sukses', 'Data Berhasil Di Edit');
        return redirect('/admin/produk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $produk = produk::find($id);
        // Untuk Menghapus data yang ada fotonya
        if ($produk->gambar != null) {
            unlink($produk->gambar);
        }

        $produk->delete();
        Alert::success('Sukses', 'Data Berhasil Di Hapus');
        return redirect('/admin/produk');
    }
}
