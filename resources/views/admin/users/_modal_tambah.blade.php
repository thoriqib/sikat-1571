<div class="modal fade" id="modalTambahUser">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('admin.users.store') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah User</h5>
          <button class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <input name="name" class="form-control mb-2" placeholder="Nama" required>
          <input name="email" type="email" class="form-control mb-2" placeholder="Email" required>
          <input name="password" type="password" class="form-control mb-2" placeholder="Password" required>

          <select name="role" class="form-control" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin">Admin</option>
            <option value="pj">PJ</option>
          </select>
        </div>

        <div class="modal-footer">
          <button class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>