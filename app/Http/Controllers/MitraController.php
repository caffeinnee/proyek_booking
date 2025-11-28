<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class MitraController extends Controller
{
    public function create()
    {
        return view('mitra.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_venue' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_wa' => 'required|string|max:20',
        ]);

        $user = Auth::user();
        $user->update([
            'nama_venue' => $request->nama_venue,
            'alamat' => $request->alamat,
            'no_wa' => $request->no_wa,
            'role' => 'mitra',
        ]);

        return redirect()->route('mitra.index')->with('success', 'Selamat! Akun Mitra Anda telah aktif. Silakan tambah lapangan Anda.');
    }

    public function index()
    {
        $userId = Auth::id();

        $lapangans = Lapangan::where('user_id', $userId)->get();

        $bookings = Booking::whereHas('lapangan', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with(['user', 'lapangan'])
        ->latest()
        ->get();

        return view('Mitra.index', [
            'lapangans' => $lapangans,
            'bookings' => $bookings
        ]);
    }

    public function createLapangan()
    {
        return view('mitra.create-lapangan');
    }

    public function storeLapangan(Request $request)
    {
        $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'jenis' => 'required|string',
            'lokasi' => 'required|string',
            'harga_per_jam' => 'required|numeric|min:0',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $gambarUrl = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            $file->move(public_path('images'), $filename);
            
            $gambarUrl = asset('images/' . $filename);
        }

        \App\Models\Lapangan::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'nama_lapangan' => $request->nama_lapangan,
            'jenis' => $request->jenis,
            'lokasi' => $request->lokasi,
            'harga_per_jam' => $request->harga_per_jam,
            'rating' => 0,
            'gambar_url' => $gambarUrl,
        ]);

        return redirect()->route('mitra.index')->with('success', 'Lapangan baru berhasil ditambahkan!');
    }

    public function destroy(Lapangan $lapangan)
    {
        if ($lapangan->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'ANDA TIDAK BERHAK MENGHAPUS LAPANGAN INI.');
        }

        $lapangan->delete();

        if (Auth::user()->is_admin) {
            return redirect()->route('super.dashboard')->with('success', 'Lapangan berhasil dihapus oleh Admin.');
        }

        return redirect()->route('mitra.index')->with('success', 'Lapangan berhasil dihapus.');
    }

    public function editLapangan(Lapangan $lapangan)
    {
        if ($lapangan->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        return view('mitra.edit-lapangan', [
            'lapangan' => $lapangan
        ]);
    }

    public function updateLapangan(Request $request, Lapangan $lapangan)
    {
        if ($lapangan->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'jenis' => 'required|string',
            'lokasi' => 'required|string',
            'harga_per_jam' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $dataUpdate = [
            'nama_lapangan' => $request->nama_lapangan,
            'jenis' => $request->jenis,
            'lokasi' => $request->lokasi,
            'harga_per_jam' => $request->harga_per_jam,
        ];

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            
            $dataUpdate['gambar_url'] = asset('images/' . $filename);
        }

        $lapangan->update($dataUpdate);

        return redirect()->route('mitra.index')->with('success', 'Data lapangan berhasil diperbarui!');
    }


}