@extends('layouts.adminlte')

@section('page-title','Master IKU')

@section('content')

<a href="#" class="btn btn-primary mb-3"
   data-toggle="modal" data-target="#modalTambah">
   <i class="fas fa-plus"></i> Tambah IKU
</a>

<button class="btn btn-secondary mb-3" data-toggle="modal" data-target="#modalCopyIku">
    <i class="fas fa-copy"></i> Copy IKU Terpilih
</button>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama IKU</th>
                    <th>Target</th>
                    <th>Realisasi</th>
                    <th>Tahun</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($iku as $i)
                <tr>
                    <td>{{ $i->kode }}</td>
                    <td>{{ $i->nama }}</td>
                    <td>{{ $i->target }}</td>
                    <td>{{ $i->realisasi ? $i->realisasi : '-' }}</td>
                    <td>{{ $i->tahun }}</td>
                    <td>
                        <a href="{{ route('admin.kegiatan.index',$i->id) }}"
                           class="btn btn-sm btn-info">
                           <i class="fas fa-folder"></i> Kegiatan
                        </a>

                        <button class="btn btn-sm btn-warning"
                            data-toggle="modal"
                            data-target="#edit{{ $i->id }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-danger"
                            data-toggle="modal"
                            data-target="#hapus{{ $i->id }}">
                            <i class="fas fa-edit"></i> Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalCopyIku">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="{{ route('admin.iku.clone') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Copy IKU Antar Tahun</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">

          {{-- Tahun sumber --}}
          <div class="form-group">
            <label>Tahun Sumber</label>
            <select id="tahun_sumber" name="tahun_asal" class="form-control" required>
              <option value="">-- Pilih Tahun --</option>
              @foreach ($daftarTahun as $th)
                <option value="{{ $th }}">{{ $th }}</option>
              @endforeach
            </select>
          </div>

          {{-- List IKU --}}
          <div id="ikuWrapper" style="display:none">
            <div class="mb-2">
              <input type="checkbox" id="checkAllIku"> Pilih Semua IKU
            </div>

            <div id="ikuList" class="row" style="max-height: 300px; overflow-y:auto"></div>
          </div>

          <hr>

          {{-- Tahun tujuan --}}
          <div class="form-group">
            <label>Tahun Tujuan</label>
            <select name="tahun_tujuan" id="tahun_tujuan" class="form-control" required>
              <option value="">-- Pilih Tahun Tujuan --</option>
              @foreach ($daftarTahun as $th)
                <option value="{{ $th }}">{{ $th }}</option>
              @endforeach
            </select>
          </div>

          {{-- Reset PJ --}}
          <div class="custom-control custom-switch">
            <input type="checkbox" name="reset_pj" value="1" class="custom-control-input" id="resetPj">
            <label class="custom-control-label" for="resetPj">
              Reset PJ Kegiatan
            </label>
          </div>

          <div id="warningDuplikat" class="alert alert-warning d-none mt-3"></div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-primary" id="btnCopy" disabled>
            Copy IKU
          </button>
        </div>

      </div>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
$('#tahun_sumber').on('change', function () {
    let tahun = $(this).val();

    $('#ikuList').html('');
    $('#ikuWrapper').hide();
    $('#btnCopy').prop('disabled', true);

    if (!tahun) return;

    $.get(`/sikat/admin/api/iku-by-tahun/${tahun}`, function (data) {
        if (!data.length) {
            $('#ikuList').html('<div class="col-12 text-muted">Tidak ada IKU di tahun ini.</div>');
        } else {
            data.forEach(i => {
                $('#ikuList').append(`
                    <div class="col-md-6">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   name="iku_ids[]"
                                   value="${i.id}"
                                   class="custom-control-input iku-item"
                                   id="iku${i.id}">
                            <label class="custom-control-label" for="iku${i.id}">
                                ${i.kode} – ${i.nama}
                            </label>
                        </div>
                    </div>
                `);
            });
        }
        $('#ikuWrapper').show();
    });
});

$('#checkAllIku').on('change', function () {
    $('.iku-item').prop('checked', this.checked);
    validateForm();
});

$(document).on('change', '.iku-item, #tahun_tujuan', function () {
    validateForm();
});

function validateForm() {
    let checked = $('.iku-item:checked').length;
    let tahunTujuan = $('#tahun_tujuan').val();

    $('#btnCopy').prop('disabled', !(checked && tahunTujuan));
}
</script>
@endpush

@include('admin.iku.modal-create')
@include('admin.iku.modal-edit')
@include('admin.iku.modal-hapus')


