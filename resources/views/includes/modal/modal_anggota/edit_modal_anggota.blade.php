<!-- Modal -->
<div class="modal fade" id="addModalAnggota" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Anggota</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form id="formadd-anggota">
          <div class="mb-3">
              <label>Nama Lengkap</label>
              <input type="text" name="nama_lengkap" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Jenis Kelamin</label>
              <select class="form-control" name="jenis_kelamin" required>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
              </select>
          </div>
          <div class="mb-3">
              <label>No Hp</label>
              <input type="text" name="no_hp" class="form-control" required>
          </div> 
          <div class="mb-3">
              <label>Email</label>
              <input type="text" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>alamat</label>
              <textarea class="form-control" rows="3" name="alamat" required></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>