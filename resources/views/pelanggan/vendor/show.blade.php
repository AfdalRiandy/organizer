@extends('pelanggan.layouts.app')

@section('title', 'Detail Layanan Vendor')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Layanan Vendor</h1>
        <a href="{{ route('pelanggan.vendors.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $jasa->nama_jasa }}</h6>
                    <span class="badge badge-info">{{ $jasa->nama_vendor }}</span>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="font-weight-bold">Harga:</h5>
                        <h4 class="text-primary">{{ $jasa->formatted_price }}</h4>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-weight-bold">Deskripsi:</h5>
                        <div>{!! $jasa->deskripsi_jasa !!}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambahkan ke Pesanan</h6>
                </div>
                <div class="card-body">
                    @if(count(auth()->user()->orders()->where('status', 'menunggu')->orWhere('status', 'disetujui')->get()) > 0)
                        <form action="{{ route('pelanggan.vendors.add-to-order') }}" method="POST">
                            @csrf
                            <input type="hidden" name="jasa_ids[]" value="{{ $jasa->id }}">
                            
                            <div class="form-group">
                                <label for="order_id">Pilih Pesanan</label>
                                <select class="form-control" id="order_id" name="order_id" required>
                                    @foreach(auth()->user()->orders()->where('status', 'menunggu')->orWhere('status', 'disetujui')->get() as $order)
                                        <option value="{{ $order->id }}">
                                            {{ $order->paket->nama }} - {{ $order->event_date->format('d M Y') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="catatan">Catatan Tambahan</label>
                                <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan jika diperlukan"></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-plus fa-sm mr-2"></i> Tambahkan ke Pesanan
                            </button>
                        </form>
                    @else
                        <div class="alert alert-warning mb-0">
                            <i class="fas fa-exclamation-triangle mr-2"></i> Anda belum memiliki pesanan aktif. 
                            <a href="{{ route('pelanggan.pakets.index') }}" class="alert-link">Pesan paket</a> terlebih dahulu.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection