@extends('vendor.layouts.app')

@section('title', 'Tambah Jasa Baru')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Jasa Baru</h1>
        <a href="{{ route('vendor.jasas.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Jasa Baru</h6>
        </div>
        <div class="card-body">
            <form id="jasaForm" action="{{ route('vendor.jasas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_vendor">Nama Vendor <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_vendor') is-invalid @enderror" id="nama_vendor" name="nama_vendor" value="{{ old('nama_vendor', Auth::user()->name) }}" required>
                    @error('nama_vendor')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nama_jasa">Nama Jasa <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_jasa') is-invalid @enderror" id="nama_jasa" name="nama_jasa" value="{{ old('nama_jasa') }}" required>
                    @error('nama_jasa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi_jasa">Deskripsi Jasa <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('deskripsi_jasa') is-invalid @enderror" id="summernote" name="deskripsi_jasa" rows="5" required>{{ old('deskripsi_jasa') }}</textarea>
                    @error('deskripsi_jasa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga_jasa">Harga Jasa (Rp) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('harga_jasa') is-invalid @enderror" id="harga_jasa" name="harga_jasa" value="{{ old('harga_jasa') }}" required>
                    @error('harga_jasa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">Aktif</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Jasa</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
      $('#summernote').summernote({
        placeholder: 'Tulis deskripsi di sini...',
        tabsize: 2,
        height: 300,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });
      
      // Show filename when file is selected
      $('.custom-file-input').on('change', function() {
          var fileName = $(this).val().split('\\').pop();
          $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
      });
    });
</script>
@endpush