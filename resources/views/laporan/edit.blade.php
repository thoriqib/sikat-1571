@extends('layouts.adminlte')

@section('title','Edit Laporan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Dokumen Laporan</h3>
    </div>

    <form action="{{ route('laporan.update', $laporan->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="form-group">
                <label>Judul</label>
                <input type="text"
                       name="judul"
                       class="form-control"
                       value="{{ $laporan->judul }}"
                       required>
            </div>

            <div class="form-group">
                <label>File PDF (opsional)</label>
                <input type="file"
                       name="file"
                       class="form-control"
                       accept="application/pdf">
                <small class="text-muted">
                    Kosongkan jika tidak ingin mengganti file
                </small>
            </div>

            <div class="form-group">
                <label>Dokumen Saat Ini</label><br>
                <a href="{{ asset('storage/'.$laporan->file_path) }}"
                   target="_blank">
                    <i class="fas fa-file-pdf"></i> Lihat Dokumen
                </a>
            </div>

        </div>

        <div class="card-footer">
            <button class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
