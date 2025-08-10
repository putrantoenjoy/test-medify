<?php

namespace App\Http\Controllers;

use App\Models\KategoriItem;
use Illuminate\Http\Request;

class KategoriItemsController extends Controller
{
    public function index(Request $request)
    {
        $query = KategoriItem::query();

        if ($request->filled('kode')) {
            $query->where('kode', 'like', '%' . $request->kode . '%');
        }
        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        $kategori = $query->paginate(10);

        return view('kategori_items.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori_items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:kategori_items,kode',
            'nama' => 'required',
        ]);

        KategoriItem::create($request->only('kode', 'nama'));

        return redirect()->route('kategori_items.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show($id)
    {
        $kategori = KategoriItem::with('masterItems')->findOrFail($id);

        return view('kategori_items.show', compact('kategori'));
    }

    public function edit($id)
    {
        $kategori = KategoriItem::findOrFail($id);
        return view('kategori_items.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriItem::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:kategori_items,kode,' . $kategori->id,
            'nama' => 'required',
        ]);

        $kategori->update($request->only('kode', 'nama'));

        return redirect()->route('kategori_items.index')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        $kategori = KategoriItem::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori_items.index')->with('success', 'Kategori berhasil dihapus');
    }
}
