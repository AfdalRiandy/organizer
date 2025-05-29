<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\Order;
use App\Models\Jasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaketController extends Controller
{
    /**
     * Display a listing of packages.
     */
    public function index()
    {
        $pakets = Paket::where('is_active', true)->get();
        return view('pelanggan.paket.index', compact('pakets'));
    }

    /**
     * Show the detail of a package.
     */
    public function show(Paket $paket)
    {
        // Get booked dates
        $bookedDates = Order::where('paket_id', $paket->id)
                          ->whereIn('status', ['menunggu', 'disetujui'])
                          ->pluck('event_date')
                          ->map(function($date) {
                              return $date->format('Y-m-d');
                          })
                          ->toJson();
        
        return view('pelanggan.paket.show', compact('paket', 'bookedDates'));
    }

    /**
     * Book a package.
     */
    public function book(Request $request, Paket $paket)
    {
        $request->validate([
            'event_date' => 'required|date|after:today',
            'catatan' => 'nullable|string',
        ]);

        // Check if date is already booked
        $isDateBooked = Order::where('paket_id', $paket->id)
                            ->where('event_date', $request->event_date)
                            ->whereIn('status', ['menunggu', 'disetujui'])
                            ->exists();
        
        if ($isDateBooked) {
            return back()->with('error', 'Tanggal tersebut sudah dipesan oleh pelanggan lain. Silakan pilih tanggal lain.');
        }

        // Create order
        Order::create([
            'user_id' => Auth::id(),
            'paket_id' => $paket->id,
            'event_date' => $request->event_date,
            'catatan' => $request->catatan,
            'status' => 'menunggu',
            'metode_pembayaran' => 'cod'
        ]);

        return redirect()->route('pelanggan.orders.index')
                         ->with('success', 'Pesanan berhasil dibuat. Silakan tunggu konfirmasi dari admin.');
    }

    /**
     * Show all orders for the current user.
     */
    public function orders()
    {
        $orders = Auth::user()->orders()->with('paket')->latest()->get();
        return view('pelanggan.orders.index', compact('orders'));
    }

    /**
     * Show detail of an order with vendor services.
     */
    public function orderDetail(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        
        // Get available vendor services that can be added
        $availableVendorServices = Jasa::where('is_active', true)->get();
        
        return view('pelanggan.orders.show', compact('order', 'availableVendorServices'));
    }

    /**
     * Remove vendor service from order.
     */
    public function removeVendorService(Request $request, Order $order, Jasa $jasa)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if the service is in pending status
        $pivotData = $order->jasas()->where('jasa_id', $jasa->id)->first()->pivot;
        if ($pivotData->status !== 'menunggu') {
            return back()->with('error', 'Hanya jasa dengan status menunggu yang dapat dihapus.');
        }

        $order->jasas()->detach($jasa->id);
        
        return back()->with('success', 'Jasa vendor berhasil dihapus dari pesanan Anda.');
    }
}