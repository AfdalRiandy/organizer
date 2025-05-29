@extends('vendor.layouts.app')

@section('title', 'Pemesanan Jasa')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pemesanan Jasa</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @forelse($bookings as $jasa)
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $jasa->nama_jasa }}</h6>
            </div>
            <div class="card-body">
                <p class="mb-4">
                    <strong>Harga:</strong> {{ $jasa->formatted_price }}
                </p>
                
                <h5 class="font-weight-bold mb-3">Daftar Pemesanan:</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Paket</th>
                                <th>Tanggal Event</th>
                                <th>Status Pesanan</th>
                                <th>Status Jasa</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jasa->orders as $order)
                                <tr class="{{ $order->pivot->status == 'menunggu' ? 'bg-warning-light' : ($order->pivot->status == 'disetujui' ? 'bg-success-light' : 'bg-danger-light') }}">
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->paket->nama }}</td>
                                    <td>{{ $order->event_date->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $order->status_badge }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $order->pivot->status == 'menunggu' ? 'warning' : ($order->pivot->status == 'disetujui' ? 'success' : 'danger') }}">
                                            {{ ucfirst($order->pivot->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('vendor.bookings.show', ['jasa' => $jasa->id, 'order' => $order->id]) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            Belum ada pemesanan untuk jasa Anda.
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

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection