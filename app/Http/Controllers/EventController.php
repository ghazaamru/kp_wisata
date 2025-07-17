<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Menampilkan daftar event.
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'superadmin') {
            $events = Event::with('user')->latest()->get();
        } else {
            $events = Event::where('user_id', $user->id)->latest()->get();
        }

        return view('admin.events.index', compact('events'));
    }

    /**
     * Menampilkan form untuk membuat event baru.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Menyimpan event baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('events', 'public');
            $data['gambar'] = $path;
        }

        $data['user_id'] = Auth::id();
        Event::create($data);

        return redirect()->route('admin.events.index')
                         ->with('success', 'Event berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit event.
     */
    public function edit(Event $event)
    {
        if (auth()->user()->role !== 'superadmin' && $event->user_id !== auth()->id()) {
            abort(403, 'AKSES DITOLAK');
        }
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Memperbarui event di database.
     */
    public function update(Request $request, Event $event)
    {
        if (auth()->user()->role !== 'superadmin' && $event->user_id !== auth()->id()) {
            abort(403, 'AKSES DITOLAK');
        }

        $request->validate([
            'nama_event' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($event->gambar) {
                Storage::disk('public')->delete($event->gambar);
            }
            $path = $request->file('gambar')->store('events', 'public');
            $data['gambar'] = $path;
        }

        $event->update($data);

        return redirect()->route('admin.events.index')
                         ->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Menghapus event dari database.
     */
    public function destroy(Event $event)
    {
        if (auth()->user()->role !== 'superadmin' && $event->user_id !== auth()->id()) {
            abort(403, 'AKSES DITOLAK');
        }

        if ($event->gambar) {
            Storage::disk('public')->delete($event->gambar);
        }

        $event->delete();
        return redirect()->route('admin.events.index')
                         ->with('success', 'Event berhasil dihapus.');
    }
}
