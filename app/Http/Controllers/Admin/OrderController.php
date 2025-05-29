<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index()
    {
        $orders = Order::with(['user', 'paket'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show order details.
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:menunggu,disetujui,lunas'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.orders.index')
                         ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}