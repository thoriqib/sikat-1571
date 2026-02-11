@extends('layouts.adminlte')

@section('title', 'Matriks Laporan')
@section('page-title', 'Matriks Tahapan × Triwulan')

@section('content')

<x-breadcrumb :items="[
    ['label' => 'IKU', 'url' => route('dashboard')],
    ['label' => $iku->nama, 'url' => route('kegiatan.index', $iku->id)],
    ['label' => $kegiatan->nama, 'url' => route('kegiatan.show', $kegiatan->id)],
    ['label' => 'Matriks']
]" />

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            {{ $kegiatan->nama }}
        </h3>
        <div class="card-tools">
            Tahun {{ $tahun }}
        </div>
    </div>

    <div class="card-body p-0">
        <table class="table table-bordered text-center mb-0">
            <thead class="bg-light">
                <tr>
                    <th>Tahapan \ Triwulan</th>
                    @foreach ($triwulan as $tw)
                        <th>{{ $tw }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($tahapan as $t)
                <tr>
                    <td class="text-left font-weight-bold">
                        {{ $t->nama }}
                    </td>

                    @foreach ($triwulan as $tw)
                        @php
                            $key = $t->id . '-' . $tw;
                            $laporanItem = $laporan->get($key);
                        @endphp

                        <td>
                            @if ($laporanItem)
                                  <div class="btn-group">

            {{-- Preview --}}
            <button type="button"
                class="btn btn-link text-success p-0 m-1"
                onclick="previewLaporan(
                    '{{ $laporanItem->link_laporan }}',
                    '{{ $kegiatan->nama }} – {{ $laporanItem->judul }} (TW {{ $laporanItem->triwulan }})'
                )">
                <i class="fas fa-eye fa-lg"></i>
            </button>

            {{-- Edit --}}
            <a href="{{ route('laporan.edit', $laporanItem->id) }}"
            class="btn btn-link text-warning p-0 m-1">
                <i class="fas fa-edit"></i>
            </a>

            {{-- Delete --}}
            <form action="{{ route('laporan.destroy', $laporanItem->id) }}"
                method="POST"
                onsubmit="return confirm('Hapus laporan ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-link text-danger p-0 m-1">
                    <i class="fas fa-trash"></i>
                </button>
            </form>

    </div>
                            @else
                                <a href="{{ route('laporan.create', [
                                    'kegiatan_id' => $kegiatan->id,
                                    'tahapan_id' => $t->id,
                                    'triwulan' => $tw,
                                    'tahun' => $tahun
                                ]) }}"
                                class="text-danger">
                                    <i class="fas fa-times-circle fa-lg"></i>
                                </a>
                            @endif
                        </td>
                    @endforeach
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="previewModal" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="previewModalTitle">
            Preview Laporan
        </h5>
        <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
        </button>
      </div>

      <div class="modal-body p-0">
        <iframe
            id="previewFrame"
            src=""
            width="100%"
            height="600"
            style="border:none;">
        </iframe>
      </div>

    </div>
  </div>
</div>


@endsection

@push('scripts')
<script>
function convertDriveLink(url) {
    // contoh konversi Google Drive
    const match = url.match(/\/d\/(.+?)\//);
    return match
        ? `https://drive.google.com/file/d/${match[1]}/preview`
        : url;
}

function previewLaporan(url, judul) {
    const embedUrl = convertDriveLink(url);

    document.getElementById('previewFrame').src = embedUrl;
    document.getElementById('previewModalTitle').innerText = judul;

    $('#previewModal').modal('show');
}
</script>
@endpush


