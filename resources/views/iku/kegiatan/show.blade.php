<!-- @extends('layouts.adminlte')

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
                                    <div class="btn-group">

                                        {{-- Preview --}}
                                        <button type="button"
                                                class="btn btn-sm btn-success btn-preview"
                                                data-toggle="modal"
                                                data-target="#pdfModal"
                                                data-file="{{ asset('storage/' . $laporanItem->file_path) }}"
                                                title="Preview">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        {{-- Edit --}}
                                        <a href="{{ route('laporan.edit', $laporanItem->id) }}"
                                           class="btn btn-sm btn-warning"
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('laporan.destroy', $laporanItem->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin hapus laporan ini?')"
                                              style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    {{-- Upload --}}
                                    <a href="{{ route('laporan.create', [
                                        'iku_id' => $iku->id,
                                        'tahapan_id' => $t->id,
                                        'triwulan' => $tw,
                                        'tahun' => $tahun
                                    ]) }}"
                                    class="btn btn-sm btn-outline-danger"
                                    title="Upload">
                                        <i class="fas fa-upload"></i>
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
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Preview Laporan</h5>
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
            style="border:none;">
        </iframe>
      </div>

    </div>
  </div>
</div>

@endsection

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
@endpush -->
