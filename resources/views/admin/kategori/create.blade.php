<div class="row p-2">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-body">
                <p><b>{{ $title }}</b></p>

                @isset($kategori)
                    <form action="/admin/kategori/{{ $kategori->id }}" method="POST">
                        @method('put')
                @else
                    <form action="/admin/kategori" method="POST">
                @endisset

                    @csrf
                    <label for="kategori">Nama Kategori</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Kategori" value="{{ isset($kategori) ? $kategori->name : old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                    {{-- Button --}}
                    <a href="/admin/kategori" class="btn btn-info mt-2"><i class="fas fa-arrow-left">Kembali</i></a>
                    <button class="btn btn-primary mt-2"><i class="fas fa-save">Simpan</i></button>
                </form>

            </div>
        </div>
    </div>
</div>