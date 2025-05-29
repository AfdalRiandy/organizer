@extends('vendor.layouts.app')
@section('title', 'Dashboard Vendor')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="{{ route('vendor.jasas.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Jasa Baru
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Jasa Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Jasa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ Auth::user()->jasas->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-wrench fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Jasa Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jasa Aktif</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ Auth::user()->jasas->where('is_active', true)->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Bookings Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Pesanan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @php
                                    $totalBookings = 0;
                                    foreach(Auth::user()->jasas as $jasa) {
                                        $totalBookings += $jasa->orders->count();
                                    }
                                    echo $totalBookings;
                                @endphp
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Bookings Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pesanan Menunggu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @php
                                    $pendingBookings = 0;
                                    foreach(Auth::user()->jasas as $jasa) {
                                        foreach($jasa->orders as $order) {
                                            if($order->pivot->status == 'menunggu') {
                                                $pendingBookings++;
                                            }
                                        }
                                    }
                                    echo $pendingBookings;
                                @endphp
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Recent Bookings -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pesanan Terbaru</h6>
                    <a href="{{ route('vendor.bookings.index') }}" class="btn btn-sm btn-primary">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Jasa</th>
                                    <th>Pelanggan</th>
                                    <th>Tanggal Event</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $recentBookings = collect();
                                    foreach(Auth::user()->jasas as $jasa) {
                                        foreach($jasa->orders as $order) {
                                            $recentBookings->push([
                                                'jasa' => $jasa,
                                                'order' => $order
                                            ]);
                                        }
                                    }
                                    $recentBookings = $recentBookings->sortByDesc(function($booking) {
                                        return $booking['order']->created_at;
                                    })->take(5);
                                @endphp

                                @forelse($recentBookings as $booking)
                                <tr>
                                    <td>{{ $booking['jasa']->nama_jasa }}</td>
                                    <td>{{ $booking['order']->user->name }}</td>
                                    <td>{{ $booking['order']->event_date->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $booking['order']->pivot->status == 'menunggu' ? 'warning' : ($booking['order']->pivot->status == 'disetujui' ? 'success' : 'danger') }}">
                                            {{ ucfirst($booking['order']->pivot->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('vendor.bookings.show', ['jasa' => $booking['jasa']->id, 'order' => $booking['order']->id]) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada pesanan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Your Services -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Jasa Anda</h6>
                    <a href="{{ route('vendor.jasas.index') }}" class="btn btn-sm btn-primary">
                        Kelola Jasa
                    </a>
                </div>
                <div class="card-body">
                    @forelse(Auth::user()->jasas->take(5) as $jasa)
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                        <div>
                            <h6 class="mb-0">{{ $jasa->nama_jasa }}</h6>
                            <small class="text-muted">{{ $jasa->formatted_price }}</small>
                        </div>
                        <span class="badge badge-{{ $jasa->is_active ? 'success' : 'danger' }}">
                            {{ $jasa->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>
                    @empty
                    <div class="text-center py-3">
                        <p class="mb-0 text-muted">Anda belum memiliki jasa</p>
                        <a href="{{ route('vendor.jasas.create') }}" class="btn btn-sm btn-primary mt-2">
                            <i class="fas fa-plus fa-sm"></i> Tambah Jasa
                        </a>
                    </div>
                    @endforelse

                    @if(Auth::user()->jasas->count() > 5)
                    <div class="text-center mt-3">
                        <a href="{{ route('vendor.jasas.index') }}" class="btn btn-sm btn-primary">
                            Lihat Semua ({{ Auth::user()->jasas->count() }})
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Info Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Penting</h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <i class="fas fa-info-circle text-info mr-1"></i> 
                        Pastikan informasi jasa Anda sudah lengkap dan akurat.
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-clock text-warning mr-1"></i>
                        Selalu periksa pesanan baru dan update statusnya.
                    </div>
                    <div>
                        <i class="fas fa-calendar-check text-success mr-1"></i>
                        Konfirmasi ketersediaan Anda sebelum menerima pesanan.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .badge {
        font-size: 85%;
        padding: 0.4em 0.6em;
    }
</style>
@endpush
