<div class="modal fade" id="modalTambah">
  <div class="modal-dialog">
    <form action="{{ route('admin.kegiatan.store') }}" method="POST">
      @csrf
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Tambah Kegiatan</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">

          <div class="form-group">
            <label>IKU: {{$iku->nama}}</label>
            <input type="hidden" name="iku_id" value="{{ $iku->id }}" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Nama Kegiatan</label>
            <input type="text" name="nama" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Penanggung Jawab (PJ)</label>
            <select name="pj_id" class="form-control">
              <option value="">-- Pilih PJ --</option>
              @foreach($users as $u)
                <option value="{{ $u->id }}">{{ $u->name }}</option>
              @endforeach
            </select>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-primary">Simpan</button>
        </div>

      </div>
    </form>
  </div>
</div>
