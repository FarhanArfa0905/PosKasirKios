<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3>Tambah Data</h3>

                    @isset($user)
                        <form action="/admin/user/{{ $user -> id }}" method="POST">
                            @method('put')
                    @else
                    <form action="/admin/user" method="POST">
                    @endisset

                        @csrf
                        <div class="form-group">
                            <label for="">Masukkan Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"  placeholder="Masukkan Nama" name="name" value="{{ isset($user) ? $user->name : '' }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="">Masukkan Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email" name="email" value="{{ isset($user) ? $user->email : '' }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Masukkan Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password" name="password" >
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Konfirmasi Password</label>
                            <input type="password" class="form-control @error('re_password') is-invalid @enderror" placeholder="Masukkan Password Kembali" name="re_password">
                            @error('re_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>

                        <a href="/admin/user" class="btn btn-info"><i class="fas fa-arrow-left">Kembali</i></a>
                        <button class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>