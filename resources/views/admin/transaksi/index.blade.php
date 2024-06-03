<div class="row p-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <p><b>{{ $title }}</b></p>
                <a href="/admin/transaksi/create" class="btn btn-primary"><i class="fas fa-plus">Tambah</i></a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>user</th>
                            <th>Subtotal</th>
                            <th>Nama Kasir</th>
                            <th>Tanggal Dibuat</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $item )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->user_id}}</td>
                                <td>{{ $item->total }}</td>
                                <td>{{ $item->kasir_name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/admin/transaksi/{{ $item->id }}/edit" class="btn btn-primary"><i class="fas fa-edit">Edit</i></a>
                                        <form action="/admin/transaksi/{{ $item->id }}" method="POST">
                                            @method('delete')
                                            <button class="btn btn-danger ml-1"><i class="fas fa-trash">Hapus</i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $transaksi->links() }}
                </div>
            </div>
        </div>
    </div>
</div>