@extends('pelanggan.layouts.app')

@section('title', 'Detail Paket')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .booked-date {
        background-color: #ffcccb !important;
        border-color: #ff8888 !important;
        color: #ff0000 !important;
    }
    .flatpickr-day.flatpickr-disabled, .flatpickr-day.prevMonthDay, .flatpickr-day.nextMonthDay {
        color: rgba(57, 57, 57, 0.3) !important;
    }
    /* Make sure the date picker is visible */
    .flatpickr-calendar {
        z-index: 1000 !important;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Paket</h1>
        <a href="{{ route('pelanggan.pakets.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $paket->nama }}</h6>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="font-weight-bold">Harga:</h5>
                        <h4 class="text-primary">{{ $paket->formatted_price }}</h4>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-weight-bold">Deskripsi:</h5>
                        <div>{!! $paket->deskripsi !!}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pesan Paket Ini</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pelanggan.pakets.book', $paket->id) }}" method="POST" id="bookingForm">
                        @csrf
                        <div class="form-group">
                            <label for="event_date">Tanggal Event <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('event_date') is-invalid @enderror" id="event_date" name="event_date" placeholder="Pilih Tanggal" required>
                            <small class="text-muted">Tanggal merah adalah tanggal yang sudah dipesan</small>
                            @error('event_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="catatan">Catatan Tambahan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan jika diperlukan">{{ old('catatan') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <div class="form-control bg-light">
                                <i class="fas fa-money-bill-wave text-success mr-2"></i> Cash on Delivery (COD)
                            </div>
                            <small class="text-muted">Saat ini hanya tersedia pembayaran COD</small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-shopping-cart fa-sm mr-2"></i> Pesan Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Parse the booked dates from JSON
        const bookedDates = {!! $bookedDates !!};
        console.log('Booked dates:', bookedDates);
        
        // Initialize date picker
        const datePicker = flatpickr("#event_date", {
            minDate: "today",
            dateFormat: "Y-m-d",
            disable: bookedDates,
            inline: false, // Set to true if you want the calendar to always be visible
            onChange: function(selectedDates, dateStr, instance) {
                console.log('Selected date:', dateStr);
            },
            onDayCreate: function(dObj, dStr, fp, dayElem) {
                // Custom styling for booked dates
                if (bookedDates.includes(dayElem.dateObj.toISOString().split('T')[0])) {
                    dayElem.className += " booked-date";
                }
            }
        });

        console.log('Flatpickr initialized:', datePicker);
    });
</script>
@endpush