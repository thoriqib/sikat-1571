@extends('layouts.adminlte')

@section('page-title', 'Daftar Kegiatan')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Kegiatan IKU: {{ $iku->kode }} – {{ $iku->nama }}
        </h3>
    </div>

    <div class="card-body">
        <ul>
            @foreach ($kegiatan as $k)
                <li>
                    <a href="{{ route('kegiatan.show', $k->id) }}">
                        {{ $k->nama }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection
