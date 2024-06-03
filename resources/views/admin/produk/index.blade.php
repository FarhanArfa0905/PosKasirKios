<div class="row p-2">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-body">
                <p><b>{{ $title }}</b></p>
                <a href="/admin/produk/create" class="btn btn-primary"><i class="fas fa-plus">Tambah</i></a>

                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->kategori_id }}</td>
                            <td>{{ $item->harga }}</td>
                            <td>{{ $item->stok }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="/admin/produk/{{ $item->id }}/edit" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                    {{-- <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a> --}}
                                    <form action="/admin/produk/{{ $item->id }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger ml-1"><i class="fas fa-trash"></i> Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $produk->links() }}
                </div>
            </div>
        </div>
    </div>
</div>