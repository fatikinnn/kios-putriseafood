<!-- Modal -->
<div class="modal custom-fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="" method="post" class="form-horizontal" id="form-produk">

      @csrf
      @method('post')

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
{{--           <div class="form-group row">
            <label for="kode_produk" class="col-md-2 col-form-label">kode</label>
            <div class="col-md-10">
              <input type="text" name="kode_produk" id="kode_produk" class="form-control" required autofocus>
              <div class="invalid-feedback">
                Harap masukkan produk.
              </div>
            </div>
          </div> --}}

          <div class="form-group row">
            <label for="nama_produk" class="col-md-2 col-form-label">Nama</label>
            <div class="col-md-10">
              <input type="text" name="nama_produk" id="nama_produk" class="form-control" required autofocus>
              <div class="invalid-feedback">
                Harap masukkan produk.
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="id_kategori" class="col-md-2 col-form-label">Jenis</label>
            <div class="col-md-10">
              <select name="id_kategori" id="id_kategori" class="form-control">
                <option value="">Pilih Jenis</option>
                @foreach ($kategori as $key => $item)
                <option value="{{ $key }}">{{ $item }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                Harap masukkan produk.
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="jenis" class="col-md-2 col-form-label">Ukuran</label>
            <div class="col-md-10">
              <select name="jenis" id="jenis" class="form-control" required>
                <option value="">Pilih Ukuran</option>
                <option value="Kecil">Kecil</option>
                <option value="Sedang">Sedang</option>
                <option value="Besar">Besar</option>
              </select>
            </div>
          </div>


          <div class="form-group row">
            <label for="harga_beli" class="col-md-2 col-form-label">Harga Beli</label>
            <div class="col-md-10">
              <input type="number" name="harga_beli" id="harga_beli" class="form-control" required>
              <div class="invalid-feedback">
                Harap masukkan produk.
              </div>
            </div>
          </div>


          <div class="form-group row">
            <label for="harga_jual" class="col-md-2 col-form-label">Harga Jual</label>
            <div class="col-md-10">
              <input type="number" name="harga_jual" id="harga_jual" class="form-control" required>
              <div class="invalid-feedback">
                Harap masukkan produk.
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="stok" class="col-md-2 col-form-label">Stok</label>
            <div class="col-md-10">
              <input type="number" name="stok" id="stok" class="form-control" value="0" step="0.1">
              <div class="invalid-feedback">
                Harap masukkan produk.
              </div>
            </div>
          </div>

          {{-- <div class="form-group row">
            <label for="diskon" class="col-md-2 col-form-label">Diskon</label>
            <div class="col-md-10">
              <input type="number" name="diskon" id="diskon" class="form-control" value="0">
              <div class="invalid-feedback">
                Harap masukkan produk.
              </div>
            </div>
          </div> --}}

        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
          <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-ban"></i> Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  document.getElementById('stok').addEventListener('input', function (e) {
      var value = e.target.value;
      e.target.value = value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
  });
</script>
