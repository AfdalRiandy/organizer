@extends('admin.layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pesanan #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
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
                            <th>Pelanggan</th>
                            <td>{{ $order->user->name }} ({{ $order->user->email }})</td>
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

            <!-- Vendor Services Section -->
            @if(count($order->jasas) > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Layanan Vendor Tambahan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Vendor</th>
                                    <th>Layanan</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->jasas as $jasa)
                                    <tr>
                                        <td>{{ $jasa->nama_vendor }} ({{ $jasa->user->name }})</td>
                                        <td>{{ $jasa->nama_jasa }}</td>
                                        <td>{{ $jasa->formatted_price }}</td>
                                        <td>
                                            <span class="badge badge-{{ $jasa->pivot->status == 'menunggu' ? 'warning' : ($jasa->pivot->status == 'disetujui' ? 'success' : 'danger') }}">
                                                {{ ucfirst($jasa->pivot->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($jasa->pivot->status == 'menunggu')
                                                <!-- Only show both buttons if status is still waiting -->
                                                <form action="{{ route('admin.orders.update-vendor-status', ['order' => $order->id, 'jasa' => $jasa->id]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="disetujui">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-check"></i> Setujui
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.orders.update-vendor-status', ['order' => $order->id, 'jasa' => $jasa->id]) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="ditolak">
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-times"></i> Tolak
                                                    </button>
                                                </form>
                                            @elseif($jasa->pivot->status == 'disetujui')
                                                <!-- Only show disabled approval button if already approved -->
                                                <button class="btn btn-sm btn-success disabled">
                                                    <i class="fas fa-check"></i> Disetujui
                                                </button>
                                            @elseif($jasa->pivot->status == 'ditolak')
                                                <!-- Only show disabled reject button if already rejected -->
                                                <button class="btn btn-sm btn-danger disabled">
                                                    <i class="fas fa-times"></i> Ditolak
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Status</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="status">Status Pesanan</label>
                            <select class="form-control" id="status" name="status">
                                <option value="menunggu" {{ $order->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="disetujui" {{ $order->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="lunas" {{ $order->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save fa-sm mr-2"></i> Update Status
                        </button>
                    </form>
                    
                    <div class="mt-4">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6 class="font-weight-bold">Panduan Status:</h6>
                                <ul class="mb-0 pl-3">
                                    <li><b>Menunggu</b>: Pesanan baru yang belum diproses</li>
                                    <li><b>Disetujui</b>: Pesanan sudah disetujui, menunggu pembayaran</li>
                                    <li><b>Lunas</b>: Pembayaran sudah diterima dan acara telah selesai</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection