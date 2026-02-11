@foreach ($iku as $i)
<div class="modal fade" id="edit{{ $i->id }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="{{ route('admin.iku.update', $i->id) }}" method="POST">
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
            <label>Kode</label>
            <input type="text" name="kode" value="{{ $i->kode }}" class="form-control">
          </div>

          <div class="form-group">
            <label>Nama IKU</label>
            <input type="text" name="nama" value="{{ $i->nama }}" class="form-control">
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
            <input type="number" name="target" value="{{ $i->target }}" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Tahun</label>
            <input type="number" name="tahun" value="{{$i->tahun}}" class="form-control"
                   value="{{ date('Y') }}" required>
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
