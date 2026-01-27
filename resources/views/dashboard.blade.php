@extends('layouts.adminlte')

@section('page-title','Dashboard')

@section('content')

<div class="row">
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

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Progress IKU Tahun {{ $tahun }}</h3>
    </div>

    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>IKU</th>
                    <th>Progress</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($iku as $i)
                <tr>
                    <td>{{ $i->kode }} – {{ $i->nama }}</td>
                    <td>
                        <div class="progress">
                            <div class="progress-bar
                                {{ $i->persentase < 100 ? 'bg-warning' : 'bg-success' }}"
                                style="width: {{ $i->persentase }}%">
                                {{ $i->persentase }}%
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('iku.show', $i->id) }}"
                           class="btn btn-sm btn-primary">
                           Detail
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
