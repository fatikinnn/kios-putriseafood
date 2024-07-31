<!-- Modal -->
<div class="modal custom-fade" id="modal-member" tabindex="-1" aria-labelledby="modal-member" aria-hidden="true">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Pilih Member</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table-responsive table-hover">
            <table class="table table-stiped table-bordered table-member">
                <thead class="text-center">
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th><i class="fa fa-cog"></i></th>
                </thead>
                <tbody>
                  @foreach ($member as $key => $item)
                    <tr>
                        <td width="5%">{{$key + 1}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->telepon}}</td>
                        <td>{{$item->alamat}}</td>
                        <td width="10%">
                          <a href="#" class="btn btn-primary btn-xs"
                          onclick="pilihMember('{{ $item->id_member }}', '{{ $item->kode_member }}')">
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
  