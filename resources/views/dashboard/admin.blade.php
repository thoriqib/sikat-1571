@extends('layouts.adminlte')

@section('title','Dashboard Admin')

@section('content')
<div class="row">

@foreach ($ikus as $iku)
    @php
        $total = 4 * 4; // 4 triwulan × 4 tahapan
        $uploaded = $iku->laporan->whereNotNull('file_path')->count();
        $persen = round(($uploaded / $total) * 100);
    @endphp

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5>{{ $iku->kode }}</h5>
                <p>{{ $iku->nama }}</p>

                <div class="progress mb-2">
                    <div class="progress-bar bg-success"
                         style="width: {{ $persen }}%">
                        {{ $persen }}%
                    </div>
                </div>

                <small>
                    PJ: {{ $iku->penanggungJawab->name ?? '-' }}
                </small>

                <a href="{{ route('iku.show', [$iku->id, 'tahun' => $tahun]) }}"
                   class="btn btn-sm btn-primary mt-2 btn-block">
                    Detail
                </a>
            </div>
        </div>
    </div>
@endforeach

</div>
@endsection
