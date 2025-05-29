@extends('admin.layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row - Summary Cards -->
    <div class="row">

        <!-- Total Orders Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pesanan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\Order::count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Pelanggan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\User::where('role', 'pelanggan')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Packages Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Paket</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\Paket::count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Vendors Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Vendor</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\User::where('role', 'vendor')->count() }}
                            </div>
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

        <!-- Order Status -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Pesanan</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Menunggu</span>
                            <span class="text-warning">{{ App\Models\Order::where('status', 'menunggu')->count() }}</span>
                        </div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-warning" role="progressbar" 
                                style="width: {{ App\Models\Order::count() > 0 ? (App\Models\Order::where('status', 'menunggu')->count() / App\Models\Order::count() * 100) : 0 }}%" 
                                aria-valuenow="{{ App\Models\Order::where('status', 'menunggu')->count() }}" 
                                aria-valuemin="0" 
                                aria-valuemax="{{ App\Models\Order::count() }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Disetujui</span>
                            <span class="text-primary">{{ App\Models\Order::where('status', 'disetujui')->count() }}</span>
                        </div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-primary" role="progressbar" 
                                style="width: {{ App\Models\Order::count() > 0 ? (App\Models\Order::where('status', 'disetujui')->count() / App\Models\Order::count() * 100) : 0 }}%" 
                                aria-valuenow="{{ App\Models\Order::where('status', 'disetujui')->count() }}" 
                                aria-valuemin="0" 
                                aria-valuemax="{{ App\Models\Order::count() }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Lunas</span>
                            <span class="text-success">{{ App\Models\Order::where('status', 'lunas')->count() }}</span>
                        </div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" role="progressbar" 
                                style="width: {{ App\Models\Order::count() > 0 ? (App\Models\Order::where('status', 'lunas')->count() / App\Models\Order::count() * 100) : 0 }}%" 
                                aria-valuenow="{{ App\Models\Order::where('status', 'lunas')->count() }}" 
                                aria-valuemin="0" 
                                aria-valuemax="{{ App\Models\Order::count() }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor Service Status -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status Layanan Vendor</h6>
                </div>
                <div class="card-body">
                    @php
                        use Illuminate\Support\Facades\DB;
                        $vendorServicesPending = DB::table('order_jasa')->where('status', 'menunggu')->count();
                        $vendorServicesApproved = DB::table('order_jasa')->where('status', 'disetujui')->count();
                        $vendorServicesRejected = DB::table('order_jasa')->where('status', 'ditolak')->count();
                        $totalVendorServices = $vendorServicesPending + $vendorServicesApproved + $vendorServicesRejected;
                    @endphp
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Menunggu Persetujuan</span>
                            <span class="text-warning">{{ $vendorServicesPending }}</span>
                        </div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-warning" role="progressbar" 
                                style="width: {{ $totalVendorServices > 0 ? ($vendorServicesPending / $totalVendorServices * 100) : 0 }}%" 
                                aria-valuenow="{{ $vendorServicesPending }}" 
                                aria-valuemin="0" 
                                aria-valuemax="{{ $totalVendorServices }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Disetujui</span>
                            <span class="text-success">{{ $vendorServicesApproved }}</span>
                        </div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" role="progressbar" 
                                style="width: {{ $totalVendorServices > 0 ? ($vendorServicesApproved / $totalVendorServices * 100) : 0 }}%" 
                                aria-valuenow="{{ $vendorServicesApproved }}" 
                                aria-valuemin="0" 
                                aria-valuemax="{{ $totalVendorServices }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Ditolak</span>
                            <span class="text-danger">{{ $vendorServicesRejected }}</span>
                        </div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-danger" role="progressbar" 
                                style="width: {{ $totalVendorServices > 0 ? ($vendorServicesRejected / $totalVendorServices * 100) : 0 }}%" 
                                aria-valuenow="{{ $vendorServicesRejected }}" 
                                aria-valuemin="0" 
                                aria-valuemax="{{ $totalVendorServices }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Pesanan Terbaru</h6>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-primary">
                Lihat Semua
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pelanggan</th>
                            <th>Paket</th>
                            <th>Tanggal Event</th>
                            <th>Status</th>
                            <th>Layanan Vendor</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $recentOrders = App\Models\Order::with(['user', 'paket', 'jasas'])
                                ->latest()
                                ->take(5)
                                ->get();
                        @endphp
                        
                        @foreach($recentOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->paket->nama }}</td>
                            <td>{{ $order->event_date->format('d M Y') }}</td>
                            <td>
                                <span class="badge badge-{{ $order->status == 'menunggu' ? 'warning' : ($order->status == 'disetujui' ? 'primary' : 'success') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->jasas->count() }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection