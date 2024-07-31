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
            <label for="created_at" class="col-md-2 col-form-label">Tanggal</label>
            <div class="col-md-10">
              <input type="date" name="created_at" id="created_at" class="form-control" required >
              <div class="invalid-feedback">
                Harap masukkan nominal.
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="deskripsi" class="col-md-2 col-form-label">Deskripsi</label>
            <div class="col-md-10">
              <input type="text" name="deskripsi" id="deskripsi" class="form-control" required autofocus>
              <div class="invalid-feedback">
                Harap masukkan deskripsi.
              </div>
            </div>
          </div>

            <div class="form-group row">
              <label for="nominal" class="col-md-2 col-form-label">Nominal</label>
              <div class="col-md-10">
                <input type="number" name="nominal" id="nominal" class="form-control" required >
                <div class="invalid-feedback">
                  Harap masukkan nominal.
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
