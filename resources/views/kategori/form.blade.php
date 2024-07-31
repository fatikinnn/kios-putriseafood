<!-- Modal -->
<div class="modal custom-fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form action="" method="post" class="form-horizontal">

      @csrf
      @method('post')

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row">
            <label for="nama_kategori" class="col-md-2 col-form-label">Nama</label>
            <div class="col-md-10">
              <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required autofocus>
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
