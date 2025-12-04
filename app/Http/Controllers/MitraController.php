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
        // Cek jika user sudah pernah mengajukan dan statusnya pending
        if (Auth::user()->status_mitra === 'pending') {
            return redirect()->route('dashboard')->with('error', 'Pengajuan Anda sedang diproses oleh Admin. Harap tunggu.');
        }

        return view('mitra.create');
    }

    public function store(Request $request)
    {
        // Validasi input ...
        $request->validate([
            'nama_venue' => 'required|string|max:255',
            'alamat' => 'required|string|max:500',
            'no_wa' => 'required|string|max:20',
        ]);

        $user = Auth::user();
        
        // Update data profil
        $user->update([
            'nama_venue' => $request->nama_venue,
            'alamat' => $request->alamat,
            'no_wa' => $request->no_wa,
            
            // --- PERHATIKAN BAGIAN INI ---
            
            // 'role' => 'mitra',      <-- HAPUS BARIS INI! (Jangan ubah role dulu)
            
            'status_mitra' => 'pending', // <-- PASTIKAN INI ADA (Ubah status jadi pending)
            
            // -----------------------------
        ]);

        return redirect()->route('dashboard')->with('success', 'Pendaftaran dikirim! Tunggu persetujuan Admin.');
    }

    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        // Pastikan hanya mitra sah yang bisa akses
        if ($user->role !== 'mitra') {
            return redirect()->route('dashboard')->with('error', 'Anda belum menjadi Mitra resmi.');
        }

        // 1. Ambil Lapangan
        $lapangans = \App\Models\Lapangan::where('user_id', $user->id)->get();

        // 2. Ambil Semua Booking Milik Mitra Ini
        $mitraBookings = \App\Models\Booking::whereHas('lapangan', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('lapangan')->get();

        // --- HITUNG STATISTIK ---
        
        // A. Total Pemasukan (Hanya dari status 'confirmed')
        $totalPendapatan = 0;
        foreach ($mitraBookings as $booking) {
            if ($booking->status == 'confirmed') {
                try {
                    $jamMulai = \Carbon\Carbon::parse($booking->jam_mulai);
                    $jamSelesai = \Carbon\Carbon::parse($booking->jam_selesai);
                    
                    // Hitung selisih jam (gunakan abs agar tidak minus)
                    $durasiJam = abs($jamSelesai->diffInHours($jamMulai));

                    // Jika durasi 0 (misal booking < 1 jam), anggap 1 jam
                    if ($durasiJam < 1) {
                        $durasiJam = 1; 
                    }
                    
                    $totalPendapatan += ($booking->lapangan->harga_per_jam * $durasiJam);
                } catch (\Exception $e) {
                    // Abaikan jika ada data jam yang error
                    continue; 
                }
            }
        }

        // B. Statistik Lainnya
        $totalOrderSukses = $mitraBookings->where('status', 'confirmed')->count();
        $orderBulanIni = $mitraBookings->filter(function ($booking) {
            return \Carbon\Carbon::parse($booking->created_at)->isCurrentMonth();
        })->count();
        $orderPending = $mitraBookings->where('status', 'pending')->count();

        return view('mitra.index', [
            'lapangans' => $lapangans,
            'totalPendapatan' => $totalPendapatan,
            'totalOrderSukses' => $totalOrderSukses,
            'orderBulanIni' => $orderBulanIni,
            'orderPending' => $orderPending,
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