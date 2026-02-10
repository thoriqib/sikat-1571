@extends('layouts.adminlte')

@section('title', 'Matriks Laporan')
@section('page-title', 'Matriks Tahapan × Triwulan')

@section('content')

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
                                    <button onclick="previewLaporan('{{ $laporan->link }}')"
                                    class="text-success">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                @else
                                    <a href="{{ route('laporan.create', [
                                        'kegiatan_id' => $kegiatan->id,
                                        'tahapan_id' => $t->id,
                                        'triwulan' => $tw,
                                        'tahun' => $tahun
                                    ]) }}"
                                       class="text-danger">
                                        <i class="fas fa-times-circle"></i>
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

@endsection

@push('scripts')
    <script>
    function previewLaporan(url) {
        const embedUrl = convertDriveLink(url);
        document.getElementById('previewFrame').src = embedUrl;
        new bootstrap.Modal(document.getElementById('previewModal')).show();
    }
    </script>
@endpush
