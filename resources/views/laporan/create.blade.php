@extends('layouts.adminlte')

@section('title', 'Upload Laporan')
@section('page-title', 'Upload Laporan')

@section('content')

<div class="row">
    <div class="col-md-8">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form Upload Laporan</h3>
            </div>

            <form action="{{ route('laporan.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="card-body">

                    {{-- Hidden Fields (dari Matrix IKU) --}}
                    <input type="hidden" name="iku_id" value="{{ $iku_id }}">
                    <input type="hidden" name="tahapan_id" value="{{ $tahapan_id }}">
                    <input type="hidden" name="triwulan" value="{{ $triwulan }}">
                    <input type="hidden" name="tahun" value="{{ $tahun }}">

                    {{-- Info --}}
                    <div class="alert alert-info">
                        <strong>Triwulan:</strong> {{ $triwulan }} <br>
                        <strong>Tahun:</strong> {{ $tahun }}
                    </div>

                    <div class="form-group">
                        <label for="judul">Judul Laporan</label>
                        <input type="text"
                            name="judul"
                            id="judul"
                            class="form-control"
                            placeholder="Contoh: Laporan Tahapan Persiapan TW I"
                            required>
                    </div>


                    {{-- File --}}
                    <div class="form-group">
                        <label for="file">File Laporan (PDF)</label>
                        <input type="file"
                               name="file"
                               id="file"
                               class="form-control"
                               accept="application/pdf"
                               required>
                        <small class="text-muted">
                            Format file: PDF
                        </small>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Upload
                    </button>

                    <a href="{{ url()->previous() }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection
