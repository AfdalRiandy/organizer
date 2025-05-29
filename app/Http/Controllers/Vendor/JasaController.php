<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Jasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JasaController extends Controller
{
    /**
     * Display a listing of the services.
     */
    public function index()
    {
        $jasas = Jasa::where('user_id', Auth::id())->latest()->get();
        return view('vendor.jasa.index', compact('jasas'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        return view('vendor.jasa.create');
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_vendor' => 'required|string|max:255',
            'nama_jasa' => 'required|string|max:255',
            'deskripsi_jasa' => 'required|string',
            'harga_jasa' => 'required|numeric|min:0',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        Jasa::create($data);

        return redirect()->route('vendor.jasas.index')
            ->with('success', 'Jasa berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Jasa $jasa)
    {
        // Check if the user is authorized to edit this service
        if ($jasa->user_id !== Auth::id()) {
            abort(403);
        }

        return view('vendor.jasa.edit', compact('jasa'));
    }

    /**
     * Update the specified service in storage.
     */
    public function update(Request $request, Jasa $jasa)
    {
        // Check if the user is authorized to update this service
        if ($jasa->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nama_vendor' => 'required|string|max:255',
            'nama_jasa' => 'required|string|max:255',
            'deskripsi_jasa' => 'required|string',
            'harga_jasa' => 'required|numeric|min:0',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $jasa->update($data);

        return redirect()->route('vendor.jasas.index')
            ->with('success', 'Jasa berhasil diperbarui!');
    }

    /**
     * Remove the specified service from storage.
     */
    public function destroy(Jasa $jasa)
    {
        // Check if the user is authorized to delete this service
        if ($jasa->user_id !== Auth::id()) {
            abort(403);
        }

        $jasa->delete();

        return redirect()->route('vendor.jasas.index')
            ->with('success', 'Jasa berhasil dihapus!');
    }
}