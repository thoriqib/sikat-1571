@extends('layouts.adminlte')

@section('title', 'Upload Laporan')
@section('page-title', 'Upload Laporan')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Form Upload Laporan</h3>
    </div>

    <form method="POST"
          action="{{ route('laporan.store') }}"
          enctype="multipart/form-data">
        @csrf

        <div class="card-body">
            {{-- isi form sama seperti yang sudah kita buat sebelumnya --}}
            {{-- tinggal copy-paste field --}}
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
