<div class="modal fade" id="modalTambah">
  <div class="modal-dialog">
    <form action="{{ route('admin.tahapan.store') }}" method="POST">
      @csrf
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Tambah Tahapan</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label>Kegiatan: {{$kegiatan->nama}}</label>
            <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id }}" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Nama Tahapan</label>
            <input type="text" name="nama" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Urutan Kegiatan</label>
            <input type="number" name="urutan" class="form-control" required>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-primary">Simpan</button>
        </div>

      </div>
    </form>
  </div>
</div>
