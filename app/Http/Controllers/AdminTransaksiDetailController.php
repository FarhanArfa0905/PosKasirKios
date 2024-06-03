<?php

namespace App\Http\Controllers;

use App\Models\transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;

class AdminTransaksiDetailController extends Controller
{
    //create function
    function create (Request $request)
    {
        // dd($request->all());
        $transaksi_id = $request->transaksi_id;
        $produk_id = $request->produk_id;
        // Menimpa Katalog Baru
        $td = TransaksiDetail::whereProdukId($produk_id)->whereTransaksiId($transaksi_id)->first();

        $transaksi = transaksi::find($transaksi_id);
        if ($td == null) {
            $data = [
                'transaksi_id' => $transaksi_id,
                'produk_id' => $produk_id,
                'produk_name' => $request->produk_name,
                'qty' => $request->qty,
                'subtotal' => $request->subtotal,
            ];
            TransaksiDetail::create($data);

            $dt = [
                'total' => $request->subtotal + $transaksi->total,
            ];

            $transaksi->update($dt);

        }else {
            $data = [
                'qty' => $request->qty + $td->qty,
                'subtotal' => $request->subtotal + $td->subtotal,
            ];
            $td->update($data);

            $dt = [
                'total' => $request->subtotal + $transaksi->total,
            ];
            $transaksi->update($dt);

        }


        return redirect('/admin/transaksi/'. $transaksi_id. '/edit');
    }

    function delete () {
        $id = request('id');
        $td = TransaksiDetail::find($id);
        $transaksi = Transaksi::find($td->transaksi_id);

        $data = [
            'total' => $transaksi->total - $td->subtotal,
        ];
        $transaksi->update($data);

        $td->delete();
        return redirect()->back();
    }

    function done ($id) {
        $transaksi = transaksi::find($id);
        $data = [
            'status' => 'selesai',
        ];

        $transaksi->update($data);
        return redirect('/admin/transaksi');
    }
}
