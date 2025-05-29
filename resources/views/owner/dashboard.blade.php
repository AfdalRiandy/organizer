@extends('owner.layouts.app')
@section('title', 'Dashboard Owner')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row - Summary Cards -->
    <div class="row">

        <!-- Total Orders Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
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

        <!-- Pending Orders Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pesanan Menunggu</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\Order::where('status', 'menunggu')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Pengguna</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ App\Models\User::count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row - Tables -->
    <div class="row">
        <!-- Recent Transactions Table -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transaksi Terbaru</h6>
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
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $recentOrders = App\Models\Order::with(['user', 'paket'])
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
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Stats -->
        <div class="col-lg-4">
            <!-- Status Summary -->
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

            <!-- User Types -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tipe Pengguna</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Admin</span>
                            <span>{{ App\Models\User::where('role', 'admin')->count() }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Pelanggan</span>
                            <span>{{ App\Models\User::where('role', 'pelanggan')->count() }}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Vendor</span>
                            <span>{{ App\Models\User::where('role', 'vendor')->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection