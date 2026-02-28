@foreach ($kegiatan as $k)
<div class="modal fade" id="hapus{{ $k->id }}" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <form action="{{ route('admin.kegiatan.destroy', $k->id) }}" method="POST">
      @csrf
      @method('DELETE')

      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title">Hapus Kegiatan</h5>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body text-center">
          <p>Yakin hapus kegiatan ini?</p>
          <strong>{{ $k->nama }}</strong>
        </div>

        <div class="modal-footer justify-content-between">
          <button class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
          <button class="btn btn-danger btn-sm">
            <i class="fas fa-edit"></i> Hapus Hapus
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endforeach