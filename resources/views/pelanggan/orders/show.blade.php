@extends('pelanggan.layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pesanan</h1>
        <a href="{{ route('pelanggan.orders.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pesanan</h6>
                    <span class="badge badge-{{ $order->status_badge }} px-3 py-2">{{ ucfirst($order->status) }}</span>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">ID Pesanan</th>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama Paket</th>
                            <td>{{ $order->paket->nama }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Event</th>
                            <td>{{ $order->event_date->format('d M Y (l)') }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>{{ $order->paket->formatted_price }}</td>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <td>{{ strtoupper($order->metode_pembayaran) }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pemesanan</th>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @if($order->catatan)
                        <tr>
                            <th>Catatan</th>
                            <td>{{ $order->catatan }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Pesanan</h6>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div><i class="fas fa-check-circle text-{{ $order->status == 'menunggu' || $order->status == 'disetujui' || $order->status == 'lunas' ? 'success' : 'secondary' }} mr-2"></i> Pemesanan</div>
                            <div class="small text-muted">{{ $order->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div><i class="fas fa-check-circle text-{{ $order->status == 'disetujui' || $order->status == 'lunas' ? 'success' : 'secondary' }} mr-2"></i> Disetujui</div>
                            <div class="small text-muted">{{ $order->status == 'disetujui' || $order->status == 'lunas' ? 'Dikonfirmasi' : 'Menunggu' }}</div>
                        </div>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-{{ $order->status == 'disetujui' || $order->status == 'lunas' ? 'success' : 'secondary' }}" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div><i class="fas fa-check-circle text-{{ $order->status == 'lunas' ? 'success' : 'secondary' }} mr-2"></i> Lunas</div>
                            <div class="small text-muted">{{ $order->status == 'lunas' ? 'Selesai' : 'Menunggu' }}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-{{ $order->status == 'lunas' ? 'success' : 'secondary' }}" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-4">
                        <i class="fas fa-info-circle mr-2"></i> 
                        @if($order->status == 'menunggu')
                            Pesanan Anda sedang menunggu persetujuan dari admin.
                        @elseif($order->status == 'disetujui')
                            Pesanan Anda telah disetujui. Silakan lakukan pembayaran COD saat acara berlangsung.
                        @elseif($order->status == 'lunas')
                            Pesanan Anda telah selesai dan pembayaran telah lunas.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection