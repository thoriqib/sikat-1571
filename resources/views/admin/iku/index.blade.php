@extends('layouts.adminlte')

@section('page-title','Master IKU')

@section('content')

<a href="#" class="btn btn-primary mb-3"
   data-toggle="modal" data-target="#modalTambah">
   <i class="fas fa-plus"></i> Tambah IKU
</a>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama IKU</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($iku as $i)
                <tr>
                    <td>{{ $i->kode }}</td>
                    <td>{{ $i->nama }}</td>
                    <td>
                        <a href="{{ route('admin.kegiatan.index',$i->id) }}"
                           class="btn btn-sm btn-info">
                           <i class="fas fa-folder"></i> Kegiatan
                        </a>

                        <button class="btn btn-sm btn-warning"
                            data-toggle="modal"
                            data-target="#edit{{ $i->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@include('admin.iku.modal-create')
@include('admin.iku.modal-edit')


