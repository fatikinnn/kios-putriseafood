<!-- Modal -->
<div class="modal custom-fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="periodeForm" class="form-horizontal">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Periode Laporan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="form-group">
            <label for="tanggal_awal">Tanggal Awal :</label>
            <div class="input-group date" id="datepicker_awal" data-target-input="nearest">
              <input type="text" name="tanggal_awal" id="tanggal_awal" class="form-control datetimepicker-input" data-target="#datepicker_awal" required
                value="{{request('tanggal_awal')}}"/>
              <div class="input-group-append" data-target="#datepicker_awal" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="tanggal_akhir">Tanggal Akhir :</label>
            <div class="input-group date" id="datepicker_akhir" data-target-input="nearest">
              <input type="text" name="tanggal_akhir" id="tanggal_akhir" class="form-control datetimepicker-input" data-target="#datepicker_akhir" required
              value="{{request('tanggal_akhir')}}"/>
              <div class="input-group-append" data-target="#datepicker_akhir" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
          <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-ban"></i> Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
