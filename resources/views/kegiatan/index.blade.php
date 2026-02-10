@extends('layouts.adminlte')

@section('page-title','Dashboard Kegiatan')

@section('content')

{{-- INFO IKU --}}
<div class="alert alert-info">
    <strong>{{ $iku->kode }}</strong> – {{ $iku->nama }} <br>
    <small>Tahun {{ $tahun }}</small>
</div>

{{-- SUMMARY --}}
<div class="row mb-3">
    <div class="col-md-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalFile }}</h3>
                <p>Laporan Terisi</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-alt"></i>
            </div>
        </div>
    </div>
</div>

<x-breadcrumb :items="[
    ['label' => 'IKU', 'url' => route('dashboard')],
    ['label' => $iku->nama, 'url' => route('kegiatan.index', $iku->id)],
]" />

{{-- TABLE KEGIATAN --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Progress Kegiatan
        </h3>
    </div>

    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kegiatan</th>
                    <th style="width:40%">Progress</th>
                    <th style="width:120px">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($kegiatan as $k)
                <tr>
                    <td>
                        <strong>{{ $k->nama }}</strong>
                    </td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar
                                {{ $k->persentase < 100 ? 'bg-warning' : 'bg-success' }}"
                                style="width: {{ $k->persentase }}%">
                                {{ $k->persentase }}%
                            </div>
                        </div>
                        <small class="text-muted">
                            {{ $k->terisi }} laporan terisi
                        </small>
                    </td>
                    <td>
                        <a href="{{ route('kegiatan.show', $k->id) }}"
                           class="btn btn-sm btn-primary">
                           <i class="fas fa-table"></i> Matriks
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">
                        Belum ada kegiatan
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
