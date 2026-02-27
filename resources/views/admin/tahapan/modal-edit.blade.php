@foreach ($tahapan as $t)
<div class="modal fade" id="edit{{ $t->id }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="{{ route('admin.tahapan.update', $t->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title">Edit Tahapan</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label>Kegiatan: {{$kegiatan->nama}}</label>
            <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id }}" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Nama Tahapan</label>
            <input type="text" name="nama" class="form-control" value="{{ $t->nama }}" required>
          </div>

          <div class="form-group">
            <label>Urutan Kegiatan</label>
            <input type="number" name="urutan" class="form-control" value="{{ $t->urutan }}" required>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button class="btn btn-warning">Update</button>
        </div>

      </form>

    </div>
  </div>
</div>
@endforeach
