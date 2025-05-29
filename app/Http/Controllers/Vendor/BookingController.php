<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the vendor service bookings.
     */
    public function index()
    {
        // Get all jasas for this vendor
        $jasas = Jasa::where('user_id', Auth::id())->pluck('id');
        
        // Get all orders with these jasas
        $bookings = Jasa::where('user_id', Auth::id())
                        ->with(['orders' => function($query) {
                            $query->with('user', 'paket');
                        }])
                        ->whereHas('orders')
                        ->get();
                        
        return view('vendor.bookings.index', compact('bookings'));
    }

    /**
     * Show details of a specific booking.
     */
    public function show($jasa_id, $order_id)
    {
        $jasa = Jasa::where('id', $jasa_id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();
        
        $order = $jasa->orders()
                       ->with('user', 'paket')
                       ->where('orders.id', $order_id)
                       ->firstOrFail();
                       
        return view('vendor.bookings.show', compact('jasa', 'order'));
    }
}