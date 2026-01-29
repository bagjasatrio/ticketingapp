<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Kategori;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $events = Event::all();
    $lokasi = Lokasi::all();       // menambahkan semua lokasi
    $categories = Kategori::all(); // menambahkan semua kategori
    return view('admin.event.index', compact('events', 'lokasi', 'categories'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Kategori::all();
        $lokasi = Lokasi::all(); // <-- tambahkan lokasi
        return view('admin.event.create', compact('categories', 'lokasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_waktu' => 'required|date',
            'lokasi_id' => 'required|exists:lokasis,id', // gunakan lokasi_id
            'kategori_id' => 'required|exists:kategoris,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('images/events'), $imageName);
            $validatedData['gambar'] = $imageName;
        }

        $validatedData['user_id'] = auth()->user()->id ?? null;

        Event::create($validatedData);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::with(['kategori', 'lokasi_relasi', 'tikets'])->findOrFail($id);
        $categories = Kategori::all();
        $lokasi = Lokasi::all();
        $tickets = $event->tikets;

        return view('admin.event.show', compact('event', 'categories', 'lokasi', 'tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::findOrFail($id);
        $categories = Kategori::all();
        $lokasi = Lokasi::all(); // <-- tambahkan lokasi
        return view('admin.event.edit', compact('event', 'categories', 'lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $event = Event::findOrFail($id);

            $validatedData = $request->validate([
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'tanggal_waktu' => 'required|date',
                'lokasi_id' => 'required|exists:lokasis,id', // gunakan lokasi_id
                'kategori_id' => 'required|exists:kategoris,id',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Handle file upload
            if ($request->hasFile('gambar')) {
                $imageName = time().'.'.$request->gambar->extension();
                $request->gambar->move(public_path('images/events'), $imageName);
                $validatedData['gambar'] = $imageName;
            }

            $event->update($validatedData);

            return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui event: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }
}
