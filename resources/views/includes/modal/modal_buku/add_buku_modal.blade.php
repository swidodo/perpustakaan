<!-- Modal -->
<div class="modal fade" id="addModalbuku" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form id="formadd-buku">
          <div class="mb-3">
              <label>Jenis Buku</label>
              <input type="text" name="jenis_buku" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Judul Buku</label>
              <input type="text" name="judul_buku" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Penerbit</label>
              <input type="text" name="penerbit" class="form-control" required>
          </div> 
          <div class="mb-3">
              <label>No Rak</label>
              <input type="number" name="no_rak" class="form-control" required>
          </div>
          <div class="mb-3">
              <label>Jumlah</label>
              <input type="number" name="jumlah" class="form-control" required>
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