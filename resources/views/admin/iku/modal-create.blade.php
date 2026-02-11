<div class="modal fade" id="modalTambah">
  <div class="modal-dialog">
    <form action="{{ route('admin.iku.store') }}" method="POST">
      @csrf
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Tambah IKU</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label>Kode IKU</label>
            <input type="text" name="kode" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Nama IKU</label>
            <input type="text" name="nama" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Satuan</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="satuan" value="persen" checked>
              <label class="form-check-label">Persen (%)</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="satuan" value="poin">
              <label class="form-check-label">Poin</label>
            </div>
          </div>

          <div class="form-group">
            <label>Target</label>
            <input type="number" name="target" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control"
                   value="{{ date('Y') }}" required>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-primary">Simpan</button>
        </div>

      </div>
    </form>
  </div>
</div>
