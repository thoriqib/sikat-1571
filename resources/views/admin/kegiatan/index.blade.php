@extends('layouts.adminlte')

@section('page-title','Master Kegiatan')

@section('content')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">IKU</li>
    <li class="breadcrumb-item active">{{ $iku->nama }}</li>
  </ol>
</nav>

<a href="#" class="btn btn-primary mb-3"
   data-toggle="modal" data-target="#modalTambah">
   <i class="fas fa-plus"></i> Tambah Kegiatan
</a>

<div class="card">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Kegiatan</th>
                <th>Penanggung Jawab</th>
                <th width="200">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kegiatan as $k)
            <tr>
                <td>{{ $k->nama }}</td>
                <td>{{ $k->pj->name }}</td>
                <td>
                    <a href="{{ route('admin.tahapan.index',$k->id) }}"
                       class="btn btn-sm btn-info">
                       <i class="fas fa-layer-group"></i> Tahapan
                    </a>
                </td>
                <td>
                    <!-- Edit -->
                    <button class="btn btn-sm btn-warning"
                        data-toggle="modal"
                        data-target="#edit{{ $k->id }}">
                        <i class="fas fa-edit"></i>
                    </button>

                    <!-- Delete -->
                    <button class="btn btn-sm btn-danger"
                        data-toggle="modal"
                        data-target="#hapus{{ $k->id }}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@if ($errors->any())
<script>
    $(function () {
        $('.modal').modal('show');
    });
</script>
@endif

@include('admin.kegiatan.modal-create')
@include('admin.kegiatan.modal-edit')
@include('admin.kegiatan.modal-hapus')

