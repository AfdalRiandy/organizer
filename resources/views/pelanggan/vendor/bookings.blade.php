@extends('pelanggan.layouts.app')

@section('title', 'Pesanan Layanan Vendor')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pesanan Layanan Vendor</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @forelse($orders as $order)
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    Pesanan #{{ $order->id }} - {{ $order->paket->nama }}
                </h6>
                <span class="badge badge-{{ $order->status_badge }}">{{ ucfirst($order->status) }}</span>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Tanggal Event:</strong> {{ $order->event_date->format('d M Y') }}
                </div>
                
                <h5 class="mb-3">Layanan Vendor:</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Vendor</th>
                                <th>Layanan</th>
                                <th>Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->jasas as $jasa)
                                <tr class="{{ $jasa->pivot->status == 'menunggu' ? 'bg-warning-light' : ($jasa->pivot->status == 'disetujui' ? 'bg-success-light' : 'bg-danger-light') }}">
                                    <td>{{ $jasa->nama_vendor }}</td>
                                    <td>{{ $jasa->nama_jasa }}</td>
                                    <td>{{ $jasa->formatted_price }}</td>
                                    <td>
                                        <span class="badge badge-{{ $jasa->pivot->status == 'menunggu' ? 'warning' : ($jasa->pivot->status == 'disetujui' ? 'success' : 'danger') }}">
                                            {{ ucfirst($jasa->pivot->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <a href="{{ route('pelanggan.orders.show', $order->id) }}" class="btn btn-primary btn-sm mt-3">
                    <i class="fas fa-eye fa-sm"></i> Lihat Detail Pesanan
                </a>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            Anda belum memiliki pesanan dengan layanan vendor.
        </div>
    @endforelse
</div>
@endsection

@push('styles')
<style>
    .bg-success-light {
        background-color: rgba(40, 167, 69, 0.1);
    }
    .bg-warning-light {
        background-color: rgba(255, 193, 7, 0.1);
    }
    .bg-danger-light {
        background-color: rgba(220, 53, 69, 0.1);
    }
</style>
@endpush