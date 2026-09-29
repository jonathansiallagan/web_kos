<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Kita hanya perlu 'extends Controller' karena mereka ada di namespace yang sama
class KamarController extends Controller 
{
    /**
     * Tampilkan daftar kamar
     */
    public function index()
    {
        $kamars = Kamar::orderBy('created_at', 'desc')->paginate(5);

        // Path ini sudah benar
        return view('pages.tables', compact('kamars'));
    }

    /**
     * Tampilkan form tambah kamar
     */
    public function create()
    {
        // Path ini sudah benar
        return view('pages.kamar-create');
    }

    /**
     * Simpan data kamar baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_kamar' => 'required|string|max:50',
            'tipe_kamar' => 'required|string|max:50',
            'harga_perbulan' => 'required|numeric',
            'ukuran' => 'required|string|max:50',
            'fasilitas' => 'nullable|string',
            'status' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('kamar', 'public');
        }

        if (!empty($validated['fasilitas'])) {
            $validated['fasilitas'] = json_encode(array_map('trim', explode(',', $validated['fasilitas'])));
        }

        Kamar::create($validated);

        return redirect()->route('tables')->with('success', 'Kamar berhasil ditambahkan.');
    }

    // Di KamarController@edit
    public function edit(Kamar $kamar)
    {
        // Ini sudah benar, tapi file-nya belum ada
        return view('pages.kamar-edit', compact('kamar')); 
    }

    /**
     * Update data kamar
     */
    public function update(Request $request, Kamar $kamar)
    {
        $validated = $request->validate([
            'no_kamar' => 'required|string|max:50|unique:kamars,no_kamar,' . $kamar->id,
            'tipe_kamar' => 'required|string|max:100',
            'harga_perbulan' => 'required|numeric',
            'ukuran' => 'nullable|string|max:100',
            'fasilitas' => 'nullable|string',
            'status' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($kamar->foto) {
                Storage::disk('public')->delete($kamar->foto);
            }
            $validated['foto'] = $request->file('foto')->store('kamar', 'public');
        }

        $validated['fasilitas'] = json_encode(explode(',', $request->fasilitas));

        $kamar->update($validated);

        return redirect()->route('tables')->with('success', 'Kamar berhasil diperbarui!');
    }

    /**
     * Hapus kamar
     */
    public function destroy(Kamar $kamar)
    {
        if ($kamar->foto) {
            Storage::disk('public')->delete($kamar->foto);
        }

        $kamar->delete();

        return redirect()->route('tables')->with('success', 'Kamar berhasil dihapus!');
    }
}