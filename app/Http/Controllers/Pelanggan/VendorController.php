<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    /**
     * Display a listing of active vendor services.
     */
    public function index()
    {
        $jasas = Jasa::where('is_active', true)->latest()->get();
        return view('pelanggan.vendor.index', compact('jasas'));
    }

    /**
     * Show vendor service details.
     */
    public function show(Jasa $jasa)
    {
        return view('pelanggan.vendor.show', compact('jasa'));
    }

    /**
     * Add vendor services to an order.
     */
    public function addToOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'jasa_ids' => 'required|array',
            'jasa_ids.*' => 'exists:jasas,id',
            'catatan' => 'nullable|string',
        ]);

        $order = Order::findOrFail($request->order_id);
        
        // Check if the order belongs to the current user
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Add the selected vendor services
        foreach ($request->jasa_ids as $jasa_id) {
            // Check if the service is already added to this order
            if (!$order->jasas->contains($jasa_id)) {
                $order->jasas()->attach($jasa_id, [
                    'status' => 'menunggu',
                    'catatan' => $request->catatan
                ]);
            }
        }

        return redirect()->route('pelanggan.orders.show', $order->id)
                         ->with('success', 'Layanan vendor berhasil ditambahkan ke pesanan Anda. Menunggu persetujuan admin.');
    }

    /**
     * Show vendor service bookings for the customer.
     */
    public function bookings()
    {
        $orders = Auth::user()->orders()
                      ->with(['jasas' => function($query) {
                          $query->with('user');
                      }])
                      ->has('jasas')
                      ->latest()
                      ->get();
                      
        return view('pelanggan.vendor.bookings', compact('orders'));
    }
}