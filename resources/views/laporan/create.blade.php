@extends('layouts.adminlte')

@section('title', 'Upload Laporan')
@section('page-title', 'Upload Laporan')

@section('content')

{{-- SUCCESS --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- ERROR GLOBAL --}}
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- =========================
MODE 1: KONTEKS DARI MATRIKS
========================= --}}
@if ($kegiatan && $tahapan && $triwulan)

<div class="card mb-3">
    <div class="card-header bg-light">
        <strong>Informasi Laporan</strong>
    </div>
    <div class="card-body p-0">
        <table class="table table-sm table-bordered mb-0">
            <tr>
                <th width="200">IKU</th>
                <td>{{ $iku->kode }} – {{ $iku->nama }}</td>
            </tr>
            <tr>
                <th>Kegiatan</th>
                <td>{{ $kegiatan->nama }}</td>
            </tr>
            <tr>
                <th>Triwulan</th>
                <td>{{ $triwulan }}</td>
            </tr>
            <tr>
                <th>Tahapan</th>
                <td>{{ $tahapan->nama }}</td>
            </tr>
            <tr>
                <th>Tahun</th>
                <td>{{ $tahun }}</td>
            </tr>
        </table>
    </div>
</div>

@endif

{{-- =========================
FORM UPLOAD (UMUM)
========================= --}}
<div class="card">
    <div class="card-header">
        <strong>Upload File Laporan</strong>
    </div>

    <div class="card-body">

        <form action="{{ route('laporan.store') }}"
              method="POST" >   
            @csrf

            {{-- MODE MANUAL --}}
            @if (!$kegiatan)
            <div class="form-group">
                <label>IKU</label>
            <select name="iku_id"
                    class="form-control select2" @error('iku_id') is-invalid @enderror">
                <option value="">-- Pilih IKU --</option>
                @foreach ($ikus as $iku)
                    <option value="{{ $iku->id }}" {{ old('iku_id') == $iku->id ? 'selected' : '' }}>
                        {{ $iku->nama }}
                    </option>
                @endforeach
            </select>
            </div>

            @error('iku_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <div class="form-group">
                <label>Kegiatan</label>
                <select name="kegiatan_id" id="kegiatan_id" class="form-control select2" disabled>
                    <option value="">-- Pilih Kegiatan --</option>
                </select>
            </div>

            <div class="form-group">
                <label>Tahapan</label>
                <select name="tahapan_id" id="tahapan_id" class="form-control select2" disabled>
                    <option value="">-- Pilih Tahapan --</option>
                </select>
            </div>

            <div class="form-group">
                <label>Triwulan</label>
                <select name="triwulan" class="form-control" required>
                    <option value="">-- Pilih Triwulan --</option>
                    @foreach ($triwulanList as $tw)
                        <option value="{{ $tw }}">{{ $tw }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tahun</label>
                <input type="number"
                       name="tahun"
                       value="{{ $tahun }}"
                       class="form-control"
                       required>
            </div>
            @else
                {{-- MODE OTOMATIS --}}
                <input type="hidden" name="kegiatan_id" value="{{ $kegiatan->id }}">
                <input type="hidden" name="tahapan_id" value="{{ $tahapan->id }}">
                <input type="hidden" name="triwulan" value="{{ $triwulan }}">
                <input type="hidden" name="tahun" value="{{ $tahun }}">
            @endif

            <div class="form-group">
                <label>Judul Laporan</label>
                <input type="text"
                       name="judul"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Link Laporan</label>
                <input type="url"
                    name="link_laporan"
                    class="form-control @error('link_laporan') is-invalid @enderror"
                    value="{{ old('link_laporan') }}"
                    required>

                @error('link_laporan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="btn btn-primary">
                Upload
            </button>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {

    $('.select2').select2({
        width: '100%'
    });

    // =====================
    // IKU → Kegiatan
    // =====================
    $('#iku_id').on('change', function () {
        let ikuId = $(this).val();

        $('#kegiatan_id').prop('disabled', true).html('');
        $('#tahapan_id').prop('disabled', true).html('');

        if (!ikuId) return;

        $.get(`/api/iku/${ikuId}/kegiatan`, function (data) {
            $('#kegiatan_id').append('<option value="">-- Pilih Kegiatan --</option>');

            data.forEach(item => {
                $('#kegiatan_id').append(
                    `<option value="${item.id}">${item.nama}</option>`
                );
            });

            $('#kegiatan_id').prop('disabled', false);
        });
    });

    // =====================
    // Kegiatan → Tahapan
    // =====================
    $('#kegiatan_id').on('change', function () {
        let kegiatanId = $(this).val();

        $('#tahapan_id').prop('disabled', true).html('');

        if (!kegiatanId) return;

        $.get(`/api/kegiatan/${kegiatanId}/tahapan`, function (data) {
            $('#tahapan_id').append('<option value="">-- Pilih Tahapan --</option>');

            data.forEach(item => {
                $('#tahapan_id').append(
                    `<option value="${item.id}">${item.nama}</option>`
                );
            });

            $('#tahapan_id').prop('disabled', false);
        });
    });

});
</script>

<script>
document.getElementById('btnPreview').addEventListener('click', function () {
    const input = document.querySelector('input[name="link_laporan"]');
    const url = input.value;

    if (!url) {
        alert('Masukkan link Google Drive terlebih dahulu');
        return;
    }

    const embedUrl = convertDriveLink(url);

    if (!embedUrl) {
        alert('Link Google Drive tidak valid');
        return;
    }

    document.getElementById('previewFrame').src = embedUrl;

    const modal = new bootstrap.Modal(document.getElementById('previewModal'));
    modal.show();
});

function convertDriveLink(url) {
    /*
     Contoh link:
     https://drive.google.com/file/d/FILE_ID/view?usp=sharing
    */
    const match = url.match(/\/d\/([a-zA-Z0-9_-]+)/);
    if (!match) return null;

    return `https://drive.google.com/file/d/${match[1]}/preview`;
}
</script>

@if ($errors->any() || session('error'))
<script>
    window.scrollTo({ top: 0, behavior: 'smooth' });
</script>
@endif
@endpush
