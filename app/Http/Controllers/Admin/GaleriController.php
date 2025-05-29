<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Display a listing of gallery items.
     */
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    /**
     * Show the form for creating a new gallery item.
     */
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Store a newly created gallery item in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/galeri', $filename);
            $data['gambar'] = $filename;
        }
        
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        Galeri::create($data);

        return redirect()->route('admin.galeris.index')
            ->with('success', 'Item galeri berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified gallery item.
     */
    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified gallery item in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($galeri->gambar) {
                Storage::delete('public/galeri/' . $galeri->gambar);
            }
            
            // Store new image
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/galeri', $filename);
            $data['gambar'] = $filename;
        } else {
            unset($data['gambar']);
        }
        
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $galeri->update($data);

        return redirect()->route('admin.galeris.index')
            ->with('success', 'Item galeri berhasil diperbarui!');
    }

    /**
     * Remove the specified gallery item from storage.
     */
    public function destroy(Galeri $galeri)
    {
        // Delete image
        if ($galeri->gambar) {
            Storage::delete('public/galeri/' . $galeri->gambar);
        }
        
        $galeri->delete();

        return redirect()->route('admin.galeris.index')
            ->with('success', 'Item galeri berhasil dihapus!');
    }
}