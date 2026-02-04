@extends('layouts.adminlte')

@section('title','Dashboard Penanggung Jawab')

@section('content')
<div class="row">

@foreach ($ikus as $iku)
    @php
        $total = 16;
        $uploaded = $iku->laporan->whereNotNull('file_path')->count();
        $persen = round(($uploaded / $total) * 100);
    @endphp

    <div class="col-md-6">
        <div class="card card-outline card-info">
            <div class="card-body">
                <h5>{{ $iku->kode }}</h5>
                <p>{{ $iku->nama }}</p>

                <div class="progress mb-2">
                    <div class="progress-bar bg-info"
                         style="width: {{ $persen }}%">
                        {{ $persen }}%
                    </div>
                </div>

                <a href="{{ route('iku.show', [$iku->id, 'tahun' => $tahun]) }}"
                   class="btn btn-info btn-sm btn-block">
                    Kelola Laporan
                </a>
            </div>
        </div>
    </div>
@endforeach

</div>
@endsection
