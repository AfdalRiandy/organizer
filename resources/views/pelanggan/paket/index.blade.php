@extends('pelanggan.layouts.app')

@section('title', 'Daftar Paket')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Paket</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        @forelse($pakets as $paket)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $paket->nama }}</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="font-weight-bold text-primary">{{ $paket->formatted_price }}</h5>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted">{{ Str::limit(strip_tags($paket->deskripsi), 100) }}</p>
                    </div>
                    <a href="{{ route('pelanggan.pakets.show', $paket->id) }}" class="btn btn-primary btn-block">
                        <i class="fas fa-eye fa-sm"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info">
                Belum ada paket yang tersedia saat ini.
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection