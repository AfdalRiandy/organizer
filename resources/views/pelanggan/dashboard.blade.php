@extends('pelanggan.layouts.app')
@section('title', 'Dashboard Pelanggan')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Welcome Message -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="font-weight-bold">Selamat Datang, {{ Auth::user()->name }}!</h5>
            <p class="mb-0">Gunakan dashboard ini untuk melihat status pesanan, mencari layanan vendor, dan mengelola event Anda.</p>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Orders Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pesanan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ Auth::user()->orders->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Events Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Event Mendatang</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ Auth::user()->orders->where('event_date', '>=', now())->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor Services Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Layanan Vendor</div>
                            @php
                                $vendorServiceCount = 0;
                                foreach(Auth::user()->orders as $order) {
                                    $vendorServiceCount += $order->jasas->count();
                                }
                            @endphp
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $vendorServiceCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-handshake fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Upcoming Events -->
        <div class="col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Event Mendatang</h6>
                    <a href="{{ route('pelanggan.orders.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                </div>
                <div class="card-body">
                    @php
                        $upcomingEvents = Auth::user()->orders()
                            ->with('paket')
                            ->where('event_date', '>=', now())
                            ->orderBy('event_date')
                            ->take(3)
                            ->get();
                    @endphp

                    @if($upcomingEvents->count() > 0)
                        @foreach($upcomingEvents as $event)
                            <div class="mb-3 pb-3 border-bottom">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="mb-0">{{ $event->paket->nama }}</h5>
                                    <span class="badge badge-{{ $event->status_badge }}">{{ ucfirst($event->status) }}</span>
                                </div>
                                <div class="mb-2">
                                    <i class="fas fa-calendar-day mr-2 text-gray-500"></i> 
                                    {{ $event->event_date->format('d M Y (l)') }}
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-layer-group mr-2 text-gray-500"></i>
                                        {{ $event->jasas->count() }} Layanan Vendor
                                    </div>
                                    <a href="{{ route('pelanggan.orders.show', $event->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <img src="{{ asset('img/empty-calendar.png') }}" alt="No Events" class="img-fluid mb-3" style="max-width: 120px;">
                            <p class="mb-0 text-muted">Belum ada event mendatang</p>
                            <a href="{{ route('pelanggan.pakets.index') }}" class="btn btn-primary mt-3">
                                <i class="fas fa-plus"></i> Pesan Paket Sekarang
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Links and Stats -->
        <div class="col-lg-5">
            <!-- Order Status -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Pesanan</h6>
                </div>
                <div class="card-body">
                    @php
                        $pendingOrders = Auth::user()->orders->where('status', 'menunggu')->count();
                        $approvedOrders = Auth::user()->orders->where('status', 'disetujui')->count();
                        $completedOrders = Auth::user()->orders->where('status', 'lunas')->count();
                        $totalOrders = Auth::user()->orders->count();
                    @endphp
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Menunggu</span>
                            <span class="text-warning">{{ $pendingOrders }}</span>
                        </div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-warning" role="progressbar" 
                                style="width: {{ $totalOrders > 0 ? ($pendingOrders / $totalOrders * 100) : 0 }}%" 
                                aria-valuenow="{{ $pendingOrders }}" 
                                aria-valuemin="0" 
                                aria-valuemax="{{ $totalOrders }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Disetujui</span>
                            <span class="text-primary">{{ $approvedOrders }}</span>
                        </div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-primary" role="progressbar" 
                                style="width: {{ $totalOrders > 0 ? ($approvedOrders / $totalOrders * 100) : 0 }}%" 
                                aria-valuenow="{{ $approvedOrders }}" 
                                aria-valuemin="0" 
                                aria-valuemax="{{ $totalOrders }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Lunas</span>
                            <span class="text-success">{{ $completedOrders }}</span>
                        </div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" role="progressbar" 
                                style="width: {{ $totalOrders > 0 ? ($completedOrders / $totalOrders * 100) : 0 }}%" 
                                aria-valuenow="{{ $completedOrders }}" 
                                aria-valuemin="0" 
                                aria-valuemax="{{ $totalOrders }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Akses Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <a href="{{ route('pelanggan.pakets.index') }}" class="btn btn-primary btn-block py-3">
                                <i class="fas fa-box fa-2x mb-2"></i><br>
                                Pesan Paket
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="{{ route('pelanggan.vendors.index') }}" class="btn btn-info btn-block py-3">
                                <i class="fas fa-handshake fa-2x mb-2"></i><br>
                                Layanan Vendor
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('pelanggan.orders.index') }}" class="btn btn-success btn-block py-3">
                                <i class="fas fa-shopping-cart fa-2x mb-2"></i><br>
                                Pesanan Saya
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('pelanggan.vendors.bookings') }}" class="btn btn-warning btn-block py-3">
                                <i class="fas fa-receipt fa-2x mb-2"></i><br>
                                Pesanan Vendor
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor Services Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Layanan Vendor Terpopuler</h6>
            <a href="{{ route('pelanggan.vendors.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
        </div>
        <div class="card-body">
            <div class="row">
                @php
                    $popularServices = App\Models\Jasa::where('is_active', true)
                        ->withCount('orders')
                        ->orderBy('orders_count', 'desc')
                        ->take(3)
                        ->get();
                @endphp

                @forelse($popularServices as $service)
                <div class="col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">{{ $service->nama_jasa }}</h6>
                            <span class="badge badge-info">{{ $service->nama_vendor }}</span>
                        </div>
                        <div class="card-body">
                            <h5 class="font-weight-bold text-primary mb-3">{{ $service->formatted_price }}</h5>
                            <p class="text-muted mb-3">{{ Str::limit(strip_tags($service->deskripsi_jasa), 100) }}</p>
                            <a href="{{ route('pelanggan.vendors.show', $service->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Lihat Detail
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
    </div>
</div>
@endsection