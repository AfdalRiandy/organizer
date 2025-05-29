<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of packages.
     */
    public function index()
    {
        $pakets = Paket::latest()->get();
        return view('admin.paket.index', compact('pakets'));
    }

    /**
     * Show the form for creating a new package.
     */
    public function create()
    {
        return view('admin.paket.create');
    }

    /**
     * Store a newly created package in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
        ]);

        Paket::create($request->all());

        return redirect()->route('admin.pakets.index')
            ->with('success', 'Paket berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified package.
     */
    public function edit(Paket $paket)
    {
        return view('admin.paket.edit', compact('paket'));
    }

    /**
     * Update the specified package in storage.
     */
    public function update(Request $request, Paket $paket)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
        ]);

        $paket->update($request->all());

        return redirect()->route('admin.pakets.index')
            ->with('success', 'Paket berhasil diperbarui!');
    }

    /**
     * Remove the specified package from storage.
     */
    public function destroy(Paket $paket)
    {
        $paket->delete();

        return redirect()->route('admin.pakets.index')
            ->with('success', 'Paket berhasil dihapus!');
    }
}