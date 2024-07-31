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
            <label for="name" class="col-md-2 col-form-label">Nama</label>
            <div class="col-md-10">
              <input type="text" name="name" id="name" class="form-control" required >
            </div>
          </div>

          <div class="form-group row">
            <label for="email" class="col-md-2 col-form-label">Email</label>
            <div class="col-md-10">
              <input type="email" name="email" id="email" class="form-control" required autofocus>
            </div>
          </div>

          <div class="form-group row">
            <label for="password" class="col-md-2 col-form-label">Password</label>
            <div class="col-md-10">
                <input type="password" name="password" id="password" class="form-control" 
                required
                minlength="6">
            </div>
        </div>
        
        <div class="form-group row">
            <label for="password_confirmation" class="col-md-2 col-form-label">Ulang Password</label>
            <div class="col-md-10">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                <div class="invalid-feedback">
                    Password tidak sesuai.
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


<script>
  document.addEventListener("DOMContentLoaded", function() {
      const password = document.getElementById("password");
      const passwordConfirmation = document.getElementById("password_confirmation");

      passwordConfirmation.addEventListener("input", function() {
          if (password.value !== passwordConfirmation.value) {
              passwordConfirmation.setCustomValidity("Password tidak sesuai.");
          } else {
              passwordConfirmation.setCustomValidity("");
          }
      });
  });
</script>
