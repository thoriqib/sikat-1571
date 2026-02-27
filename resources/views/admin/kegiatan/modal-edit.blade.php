@foreach ($kegiatan as $k)
<div class="modal fade" id="edit{{ $k->id }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="{{ route('admin.kegiatan.update', $k->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title">Edit IKU</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label>{{$iku->nama}}</label>
            <input type="hidden" name="iku_id" value="{{ $iku->id }}" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Nama Kegiatan</label>
            <input type="text" name="nama" class="form-control" value="{{ $k->nama }}" required>
          </div>

          <div class="form-group">
            <label>Penanggung Jawab (PJ)</label>
             <select name="pj_id" class="form-control">
              <option value="">-- Pilih PJ --</option>
              @foreach($users as $u)
                <option value="{{ $u->id }}"
                    {{ $k->pj_id == $u->id ? 'selected' : '' }}>
                    {{ $u->name }}
                </option>
              @endforeach
            </select>
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
