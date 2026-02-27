@extends('layouts.adminlte')

@section('page-title','Master Tahapan')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Kegiatan</li>
    <li class="breadcrumb-item active">{{ $kegiatan->nama }}</li>
  </ol>
</nav>

<a href="#" class="btn btn-primary mb-3"
   data-toggle="modal" data-target="#modalTambah">
   <i class="fas fa-plus"></i> Tambah Tahapan
</a>

<div class="card">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Urutan</th>
                <th>Nama Tahapan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tahapan as $t)
            <tr>
                <td>{{ $t->urutan }}</td>
                <td>{{ $t->nama }}</td>
                <td>
                    <!-- Edit -->
                    <button class="btn btn-sm btn-warning"
                        data-toggle="modal"
                        data-target="#edit{{ $t->id }}">
                        <i class="fas fa-edit"></i>
                    </button>

                    <!-- Delete -->
                    <button class="btn btn-sm btn-danger"
                        data-toggle="modal"
                        data-target="#hapus{{ $t->id }}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>           
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@include('admin.tahapan.modal-create')
@include('admin.tahapan.modal-edit')
@include('admin.tahapan.modal-hapus')
