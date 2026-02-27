@foreach($users as $u)
<div class="modal fade" id="modalHapusUser{{ $u->id }}">
  <div class="modal-dialog modal-sm">
    <form method="POST" action="{{ route('admin.users.destroy', $u->id) }}">
      @csrf @method('DELETE')
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title">Hapus User</h5>
        </div>
        <div class="modal-body text-center">
          Yakin hapus <b>{{ $u->name }}</b>?
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button class="btn btn-danger">Hapus</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endforeach