@extends('layouts.adminlte')

@section('page-title','Dashboard IKU')

@section('content')

{{-- SUMMARY --}}
<div class="row mb-3">
    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalFile }}</h3>
                <p>File Laporan</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-upload"></i>
            </div>
        </div>
    </div>
</div>

{{-- TABLE IKU --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Progress IKU Tahun {{ $tahun }}
        </h3>
    </div>

    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>IKU</th>
                    <th style="width:40%">Progress</th>
                    <th style="width:120px">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($iku as $i)
                <tr>
                    <td>
                        <strong>{{ $i->kode }}</strong><br>
                        <small class="text-muted">{{ $i->nama }}</small>
                    </td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar
                                {{ $i->persentase < 70 ? ($i->persentase < 40? 'bg-danger' : 'bg-warning') : 'bg-success' }}"
                                style="width: {{ $i->persentase }}%">
                                {{ $i->persentase }}%
                            </div>
                        </div>
                        <small class="text-muted">
                            {{ $i->uploaded_laporan }} dari {{ $i->target_laporan }} laporan terisi
                        </small>
                    </td>
                    <td>
                        <a href="{{ route('kegiatan.index', $i->id) }}"
                           class="btn btn-sm btn-primary">
                           <i class="fas fa-folder-open"></i> Kegiatan
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
