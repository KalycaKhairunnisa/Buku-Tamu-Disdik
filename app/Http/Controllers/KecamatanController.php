<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\Authenticate::class);
        $this->middleware(\App\Http\Middleware\Admin::class)->except('show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kecamatan = Kecamatan::paginate(15);
        return view('kecamatan.index', compact('kecamatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kecamatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kecamatan,nama',
            'keterangan' => 'nullable|string',
        ]);

        Kecamatan::create($validated);

        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kecamatan $kecamatan)
    {
        return view('kecamatan.show', compact('kecamatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kecamatan $kecamatan)
    {
        return view('kecamatan.edit', compact('kecamatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kecamatan,nama,' . $kecamatan->id,
            'keterangan' => 'nullable|string',
        ]);

        $kecamatan->update($validated);

        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->delete();
        return redirect()->route('kecamatan.index')->with('success', 'Kecamatan berhasil dihapus');
    }
}
