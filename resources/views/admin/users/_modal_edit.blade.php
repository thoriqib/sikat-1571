@foreach($users as $u)
<div class="modal fade" id="modalEditUser{{ $u->id }}">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('admin.users.update', $u->id) }}">
      @csrf @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5>Edit User</h5>
          <button class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <input name="name" class="form-control mb-2" value="{{ $u->name }}" required>
          <input name="email" class="form-control mb-2" value="{{ $u->email }}" required>
          <input name="password" type="password" class="form-control mb-2" placeholder="(Opsional) Password baru">

          <select name="role" class="form-control">
            <option value="admin" {{ $u->role=='admin'?'selected':'' }}>Admin</option>
            <option value="pj" {{ $u->role=='pj'?'selected':'' }}>PJ</option>
          </select>
        </div>

        <div class="modal-footer">
          <button class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endforeach