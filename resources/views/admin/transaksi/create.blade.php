<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">

                {{-- Kode Produk --}}
                <div class="row mt-1">
                    <div class="col-md-4">
                        <label for="">Kode Produk</label>
                    </div>
                    <div class="col-md-8">
                        <form action="" method="GET">
                            <div class="d-flex">
                                <select name="produk_id"  class="form-control" id="">
                                    <option value="">{{ isset($p_detail) ? $p_detail->name : '-Nama Produk-' }}</option>
                                    @foreach ($produk as $item)
                                        <option value="{{ $item->id }}">{{$item->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Pilih</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                {{-- Nama Produk --}}
                <form action="/admin/transaksi/detail/create" method="POST">
                    @csrf
                    
                    <input type="hidden" name="transaksi_id" value="{{ Request::segment(3) }}">
                    <input type="hidden" name="produk_id" value="{{ isset($p_detail) ? $p_detail->id : '' }}">
                    <input type="hidden" name="produk_name" value="{{ isset($p_detail) ? $p_detail->name : '' }}">
                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">

                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label for="">Nama Produk</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{{ isset($p_detail) ? $p_detail->name : '' }}" disabled class="form-control" name="nama_produk">
                        </div>
                    </div>

                    {{-- Harga Satuan --}}
                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label for="">Harga Satuan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" value="{{ isset($p_detail) ? $p_detail->harga : '' }}" disabled class="form-control" name="harga_satuan">
                        </div>
                    </div>

                    {{-- Qty --}}
                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label for="">QTY</label>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex">
                                <a href="?produk_id={{ request('produk_id') }}&act=min&qty={{ $qty }}" class="btn btn-primary"><i class="fas fa-minus"></i></a>
                                <input type="number" class="form-control" name="qty" value="{{ $qty }}" id="qty">
                                <a href="?produk_id={{ request('produk_id') }}&act=plus&qty={{ $qty }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    {{-- Subtotal --}}
                    <div class="row mt-1">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-8">
                            <h5>Subtotal: Rp. {{ format_rupiah($subtotal) }}</h5>
                        </div>
                    </div>

                    {{-- Button Kembali dan Tambah --}}
                    <div class="row mt-1">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-8">
                            <a href="/admin/transaksi" class="btn btn-primary"><i class="fas fa-arrow-left">Kembali</i></a>
                            <button class="btn btn-primary"><i class="fas fa-plus">Tambah</i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Kolom Kanan --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <table class="table mb-2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>QTY</th>
                            <th>Subtotal</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi_detail as $item)    
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->produk_name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ 'Rp. '.format_rupiah($item->subtotal) }}</td>
                                <td>
                                    <a href="/admin/transaksi/detail/delete?id={{ $item->id }}" class="fas fa-times"></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="/admin/transaksi/detail/selesai/{{ Request::segment(3) }}" class="btn btn-success"><i class="fas fa-save">Simpan</i></a>
                <a href="" class="btn btn-info"><i class="fas fa-file">Pending</i></a>
            </div>
        </div>
    </div>
</div>

{{-- Kolom Kedua --}}
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form action="" method="GET">
                    {{-- Total Belanja --}}
                    <div class="form-group">
                        <label for="">Total Belanja</label>
                        <input type="number" class="form-control" name="total_belanja" value="{{ format_rupiah($transaksi->total) }}">
                    </div>
                    {{-- Dibayarkan --}}
                    <div class="form-group">
                        <label for="">Dibayarkan</label>
                        <input type="number" class="form-control" name="dibayarkan" value="{{ format_rupiah(request('dibayarkan')) }}">
                    </div>


                    {{-- Tombol hitung --}}
                    <button class="btn btn-primary btn-block">Hitung</button>

                    {{-- Uang Kembalian --}}
                    <div class="form-group">
                        <label for="">Kembalian</label>
                        <input type="number" disabled class="form-control" name="kembalian" value="{{ format_rupiah($kembalian) }}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>