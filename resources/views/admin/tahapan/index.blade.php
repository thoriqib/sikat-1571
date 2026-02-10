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
            </tr>
        </thead>
        <tbody>
            @foreach ($tahapan as $t)
            <tr>
                <td>{{ $t->urutan }}</td>
                <td>{{ $t->nama }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
