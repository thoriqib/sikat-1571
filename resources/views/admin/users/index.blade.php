@extends('layouts.adminlte')

@section('page-title','Manajemen User')

@section('content')

<a href="#" class="btn btn-primary mb-3"
   data-toggle="modal" data-target="#modalTambahUser">
   <i class="fas fa-plus"></i> Tambah User
</a>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <span class="badge badge-{{ $u->role == 'admin' ? 'danger' : 'info' }}">
                            {{ strtoupper($u->role) }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-warning"
                            data-toggle="modal"
                            data-target="#modalEditUser{{ $u->id }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>

                        <button class="btn btn-sm btn-danger"
                            data-toggle="modal"
                            data-target="#modalHapusUser{{ $u->id }}">
                            <i class="fas fa-edit"></i> Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('admin.users._modal_tambah')
@include('admin.users._modal_edit')
@include('admin.users._modal_hapus')

@endsection