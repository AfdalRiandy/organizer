<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of service bookings.
     */
    public function index()
    {
        // Get all services for this vendor
        $jasas = Jasa::where('user_id', Auth::id())->with(['orders' => function($query) {
            $query->with('user', 'paket');
        }])->get();

        return view('vendor.orders.index', compact('jasas'));
    }

    /**
     * Show booking details.
     */
    public function show(Jasa $jasa, $orderId)
    {
        // Check if service belongs to logged-in vendor
        if ($jasa->user_id !== Auth::id()) {
            abort(403);
        }

        $orderDetail = $jasa->orders()->with('user', 'paket')->findOrFail($orderId);
        
        return view('vendor.orders.show', compact('jasa', 'orderDetail'));
    }
}