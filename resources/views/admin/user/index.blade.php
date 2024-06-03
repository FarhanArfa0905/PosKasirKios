<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <p><b>{{ $title }}</b></p>
                    <a href="/admin/user/create" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah</a>

                    @if (session()->has('success'))
                        <div class="alert alert-success mt-2">
                            <i class="fas fa-check">
                                {{ session('success') }}
                            </i>
                        </div>
                    @endif
                    <table class="table mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/admin/user/{{ $item->id }}/edit" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                        {{-- <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a> --}}
                                        <form action="/admin/user/{{ $item->id }}" method="POST">
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
                </div>
            </div>
        </div>
    </div>
</div>
