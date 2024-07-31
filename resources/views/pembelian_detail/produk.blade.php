<div class="modal custom-fade" id="modal-produk" tabindex="-1" aria-labelledby="modal-produk" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Pilih Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="modal-body">
                <div class="table-responsive table-hover">
                  <table class="table table-stiped table-bordered table-produk">
                      <thead class="text-center">
                          <tr>
                              <th width="5%">No</th>
                              <th>Kode</th>
                              <th>Nama</th>
                              <th>Ukuran</th>
                              <th>Harga Beli</th>
                              <th width="5%"><i class="fa fa-cog"></i></th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($produk as $key => $item)
                              <tr>
                                  <td width="5%">{{ $key+1 }}</td>
                                  <td><span class="badge badge-warning">{{ $item->kode_produk }}</span></td>
                                  <td>{{ $item->nama_produk }}</td>
                                  <td>{{ $item->jenis }}</td>
                                  <td>{{ format_uang($item->harga_beli) }}</td>
                                  <td width="15%">
                                      <a href="#" class="btn btn-primary btn-xs"
                                          onclick="pilihProduk('{{ $item->id_produk }}', '{{ $item->kode_produk }}')">
                                          <i class="fa fa-check-circle"></i>
                                          Pilih
                                      </a>
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
