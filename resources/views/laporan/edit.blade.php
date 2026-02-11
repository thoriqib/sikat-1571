@extends('layouts.adminlte')

@section('title','Edit Laporan')
@section('page-title','Edit Laporan')

@section('content')

<div class="card">
    <div class="card-body">

        <form method="POST" action="{{ route('laporan.update', $laporan->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>IKU</label>
                <input type="text" class="form-control"
                       value="{{ $laporan->kegiatan->iku->nama }}" disabled>
            </div>

            <div class="form-group">
                <label>Kegiatan</label>
                <input type="text" class="form-control"
                       value="{{ $laporan->kegiatan->nama }}" disabled>
            </div>

            <div class="form-group">
                <label>Tahapan</label>
                <input type="text" class="form-control"
                       value="{{ $laporan->tahapan->nama }}" disabled>
            </div>

            <div class="form-group">
                <label>Triwulan</label>
                <input type="text" class="form-control"
                       value="TW {{ $laporan->triwulan }}" disabled>
            </div>

            <div class="form-group">
                <label>Link Laporan</label>
                <input type="url"
                       name="link_laporan"
                       class="form-control"
                       value="{{ old('link_laporan', $laporan->link_laporan) }}"
                       required>
            </div>

            <button class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
            </button>

            <a href="{{ route('kegiatan.show', $laporan->kegiatan_id) }}"
               class="btn btn-secondary">
               Kembali
            </a>

        </form>

    </div>
</div>

@endsection
