<!-- Modal -->
<div class="modal custom-fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-lg" >
    <form action="" method="post" class="form-horizontal">

      @csrf
      @method('post')

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="nama" class="col-md-2 col-form-label">Nama</label>
            <div class="col-md-10">
              <input type="text" name="nama" id="nama" class="form-control" required autofocus>
              <div class="invalid-feedback">
                Harap masukkan kategori.
              </div>
            </div>
          </div>

            <div class="form-group row">
              <label for="telepon" class="col-md-2 col-form-label">Telepon</label>
              <div class="col-md-10">
                <input type="text" name="telepon" id="telepon" class="form-control" required >
                <div class="invalid-feedback">
                  Harap masukkan kategori.
                </div>
              </div>
            </div>


            <div class="form-group row">
              <label for="alamat" class="col-md-2 col-form-label">Alamat</label>
              <div class="col-md-10">
                <textarea name="alamat" id="alamat" rows="3" class="form-control" required></textarea>
                <div class="invalid-feedback">
                  Harap masukkan kategori.
                </div>
              </div>
            </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
          <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-ban"></i> Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
