<!-- Modal -->
<div class="modal custom-fade" id="modal-supplier" tabindex="-1" aria-labelledby="modal-supplier" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pilih Supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="table-responsive table-hover">
            <table class="table table-stiped table-bordered table-supplier">
                <thead class="text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th><i class="fa fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($supplier as $key => $item)
                    <tr>
                        <td width="5%">{{$key + 1}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->telepon}}</td>
                        <td>{{$item->alamat}}</td>
                        <td width="10%">
                          <a href={{route('pembelian.create', $item->id_supplier)}} class="btn btn-primary btn-xs btn-flat">
                            <i class="fa fa-check-circle">
                              Pilih
                            </i>
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
