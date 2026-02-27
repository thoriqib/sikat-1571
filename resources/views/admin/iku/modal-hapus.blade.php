@foreach ($iku as $i)
<div class="modal fade" id="hapus{{ $i->id }}" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <form action="{{ route('admin.iku.destroy', $i->id) }}" method="POST">
      @csrf
      @method('DELETE')

      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title">Hapus Kegiatan</h5>
          <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body text-center">
          <p>Yakin hapus IKU ini?</p>
          <strong>{{ $i->nama }}</strong>
        </div>

        <div class="modal-footer justify-content-between">
          <button class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
          <button class="btn btn-danger btn-sm">
            <i class="fas fa-trash"></i> Hapus
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
@endforeach