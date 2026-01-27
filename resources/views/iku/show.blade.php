@extends('layouts.adminlte')

@section('title', 'Detail IKU')
@section('page-title', 'Progress IKU')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            {{ $iku->kode }} – {{ $iku->nama }}
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
                                <a href="#"
                                class="text-success"
                                data-toggle="modal"
                                data-target="#pdfModal"
                                data-file="{{ asset('storage/' . $laporanItem->file_path) }}">
                                    <i class="fas fa-check-circle"></i>
                                </a>

                            @else
                                <a href="{{ route('laporan.create', [
                                        'iku_id' => $iku->id,
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

{{-- Modal Preview PDF --}}
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" data-title="{{ $iku->nama }} - TW {{ $tw }}"
>
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">
            Preview Laporan
        </h5>
        <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
        </button>
      </div>

      <div class="modal-body p-0">
        <iframe
            id="pdfFrame"
            src=""
            width="100%"
            height="600px"
            style="border: none;">
        </iframe>
      </div>

    </div>
  </div>
</div>

@push('scripts')
<script>
    $('#pdfModal').on('show.bs.modal', function (event) {
        let button = $(event.relatedTarget);
        let file = button.data('file');

        $('#pdfFrame').attr('src', file);
    });

    $('#pdfModal').on('hidden.bs.modal', function () {
        $('#pdfFrame').attr('src', '');
    });
</script>
@endpush


@endsection
