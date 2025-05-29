@extends('pelanggan.layouts.app')

@section('title', 'Daftar Layanan Vendor')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Layanan Vendor</h1>
    </div>

    <div class="row">
        @forelse($jasas as $jasa)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $jasa->nama_jasa }}</h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <span class="badge badge-info">{{ $jasa->nama_vendor }}</span>
                    </div>
                    <div class="mb-3">
                        <h5 class="font-weight-bold text-primary">{{ $jasa->formatted_price }}</h5>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted">{{ Str::limit(strip_tags($jasa->deskripsi_jasa), 100) }}</p>
                    </div>
                    <a href="{{ route('pelanggan.vendors.show', $jasa->id) }}" class="btn btn-primary btn-block">
                        <i class="fas fa-eye fa-sm"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                Belum ada layanan vendor yang tersedia saat ini.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection