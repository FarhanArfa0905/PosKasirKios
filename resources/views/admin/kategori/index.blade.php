<div class="row p-2">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-body">
                <p><b>{{ $title }}</b></p>
                <a href="/admin/kategori/create" class="btn btn-primary"><i class="fas fa-plus">Tambah</i></a>

                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="/admin/kategori/{{ $item->id }}/edit" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                    {{-- <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a> --}}
                                    <form action="/admin/kategori/{{ $item->id }}" method="POST">
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
                    {{ $kategori->links() }}
                </div>
            </div>
        </div>
    </div>
</div>