<div class="row p-2">
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-body">
                <p><b>{{ $title }}</b></p>

                @isset($produk)
                    <form action="/admin/produk/{{ $produk->id }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                @else
                    <form action="/admin/produk" method="POST" enctype="multipart/form-data">
                @endisset

                    @csrf
                    {{-- Nama Kategori --}}
                    <label for="">Nama Produk</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Masukkan Produk" value="{{ isset($produk) ? $produk->name : old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>  
                    @enderror

                    {{-- Kategori Id --}}
                    <label for="">Nama Kategori</label>
                    <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" id="">
                        <option value="">--Kategori--</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}" {{ isset($produk) ? $item->id == $produk ->kategori_id ? 'selected' : '' : '' }}>{{ $item->name }}</option>
                        @endforeach
                    </select>

                    @error('kategori_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                    {{-- Harga --}}
                    <label for="">Harga</label>
                    <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" placeholder="Masukkan Harga" value="{{ isset($produk) ? $produk->harga : old('harga') }}">
                    @error('harga')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                    {{-- Stok --}}
                    <label for="">Stok</label>
                    <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok" placeholder="Masukkan Stok" value="{{ isset($produk) ? $produk->stok : old('stok') }}">
                    @error('stok')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                    {{-- Upload Gambar --}}
                    <label for="">Gambar</label>
                    <input type="file" class="form-control" name="gambar" placeholder="Masukkan Gambar" value="{{ isset($produk) ? $produk->name : old('gambar') }}">

                    @isset($produk)
                        <img src="/{{ $produk->gambar }}" width="200px" alt="">
                    @endisset

                    <br>

                    {{-- Button --}}
                    <a href="/admin/produk" class="btn btn-info mt-2"><i class="fas fa-arrow-left">Kembali</i></a>
                    <button class="btn btn-primary mt-2"><i class="fas fa-save">Simpan</i></button>
                </form>

            </div>
        </div>
    </div>
</div>