<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class AdminTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Halaman Transaksi
        $data = [
            'title' => 'Manajemen Transaksi',
            'transaksi' => transaksi::orderBy('created_at', 'DESC')->paginate(5),
            'content' => 'admin.transaksi.index'
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Halaman create
        $data = [
            'user_id' => auth()->user()->id,
            'kasir_name' => auth()->user()->name,
            'total' => 0,
        ];
        
        $transaksi = transaksi::create($data);
        return redirect('/admin/transaksi/'. $transaksi->id. '/edit');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $produk = produk::get();
        $transaksi_detail = TransaksiDetail::whereTransaksiId($id)->get();

        $produk_id = request('produk_id');
        $p_detail = produk::find($produk_id);

        $act = request('act');
        $qty = request('qty');
        if ($act == 'min') {
            if ($qty <= 1) {
                $qty = 1;
            } else {
                $qty = $qty - 1;
            }
        }else {
            $qty = $qty + 1;
        }

        // Debugging untuk memastikan nilai produk_id dan p_detail
        // Memastikan terlebihan dulu $p_detail terbaca atau terpilih sehingga tidak menghasilkan error null
        if ($p_detail) {
            $subtotal = $qty * $p_detail->harga;
        } else {
            $subtotal = 0;
        }

        $transaksi = transaksi::find($id);

        $dibayarkan = request('dibayarkan');
        $kembalian = $dibayarkan - $transaksi->total;

        $data = [
            'title' => 'Manajemen Transaksi',
            'produk' => $produk,
            'p_detail' => $p_detail,
            'qty' => $qty,
            'transaksi' => $transaksi,
            'transaksi_detail' => $transaksi_detail,
            'subtotal' => $subtotal,
            'kembalian' => $kembalian,
            'content' => 'admin.transaksi.create'
        ];

        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
