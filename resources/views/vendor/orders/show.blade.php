@extends('vendor.layouts.app')

@section('title', 'Detail Pemesanan')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pemesanan</h1>
        <a href="{{ route('vendor.bookings.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pemesanan</h6>
                    <div>
                        <span class="badge badge-{{ $orderDetail->status_badge }} mr-2">Pesanan: {{ ucfirst($orderDetail->status) }}</span>
                        <span class="badge badge-{{ $orderDetail->pivot->status == 'menunggu' ? 'warning' : ($orderDetail->pivot->status == 'disetujui' ? 'success' : 'danger') }}">
                            Jasa: {{ ucfirst($orderDetail->pivot->status) }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">ID Pesanan</th>
                            <td>{{ $orderDetail->id }}</td>
                        </tr>
                        <tr>
                            <th>Pelanggan</th>
                            <td>{{ $orderDetail->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email Pelanggan</th>
                            <td>{{ $orderDetail->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Paket</th>
                            <td>{{ $orderDetail->paket->nama }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Event</th>
                            <td>{{ $orderDetail->event_date->format('d M Y (l)') }}</td>
                        </tr>
                        <tr>
                            <th>Layanan Anda</th>
                            <td>{{ $jasa->nama_jasa }}</td>
                        </tr>
                        <tr>
                            <th>Harga Layanan</th>
                            <td>{{ $jasa->formatted_price }}</td>
                        </tr>
                        <tr>
                            <th>Status Layanan</th>
                            <td>
                                <span class="badge badge-{{ $orderDetail->pivot->status == 'menunggu' ? 'warning' : ($orderDetail->pivot->status == 'disetujui' ? 'success' : 'danger') }} px-3 py-2">
                                    {{ ucfirst($orderDetail->pivot->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Pemesanan</th>
                            <td>{{ $orderDetail->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @if($orderDetail->pivot->catatan)
                        <tr>
                            <th>Catatan</th>
                            <td>{{ $orderDetail->pivot->catatan }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Pemesanan</h6>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div><i class="fas fa-check-circle text-success mr-2"></i> Pemesanan</div>
                            <div class="small text-muted">{{ $orderDetail->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div><i class="fas fa-check-circle text-{{ $orderDetail->pivot->status == 'disetujui' ? 'success' : 'secondary' }} mr-2"></i> Disetujui Admin</div>
                            <div class="small text-muted">{{ $orderDetail->pivot->status == 'disetujui' ? 'Ya' : ($orderDetail->pivot->status == 'ditolak' ? 'Ditolak' : 'Menunggu') }}</div>
                        </div>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-{{ $orderDetail->pivot->status == 'disetujui' ? 'success' : ($orderDetail->pivot->status == 'ditolak' ? 'danger' : 'warning') }}" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div><i class="fas fa-check-circle text-{{ $orderDetail->status == 'lunas' ? 'success' : 'secondary' }} mr-2"></i> Acara Selesai</div>
                            <div class="small text-muted">{{ $orderDetail->status == 'lunas' ? 'Selesai' : 'Belum' }}</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-{{ $orderDetail->status == 'lunas' ? 'success' : 'secondary' }}" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <div class="alert alert-{{ $orderDetail->pivot->status == 'disetujui' ? 'success' : ($orderDetail->pivot->status == 'ditolak' ? 'danger' : 'warning') }} mt-4">
                        <i class="fas fa-info-circle mr-2"></i> 
                        @if($orderDetail->pivot->status == 'menunggu')
                            Permintaan layanan masih menunggu persetujuan admin.
                        @elseif($orderDetail->pivot->status == 'disetujui')
                            Permintaan layanan telah disetujui. Silakan bersiap untuk acara pada tanggal {{ $orderDetail->event_date->format('d M Y') }}.
                        @elseif($orderDetail->pivot->status == 'ditolak')
                            Permintaan layanan ditolak oleh admin.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection