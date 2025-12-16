<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada

class MitraController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        if ($user->role === 'mitra') {
            return redirect()->route('mitra.index')->with('info', 'Anda sudah terdaftar sebagai Mitra.');
        }

        if ($user->status_mitra === 'pending') {
            return redirect()->route('dashboard')->with('error', 'Pengajuan Anda sedang diproses oleh Admin. Harap tunggu.');
        }

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
            'status_mitra' => 'pending', 
        ]);

        return redirect()->route('dashboard')->with('success', 'Pendaftaran dikirim! Tunggu persetujuan Admin.');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'mitra') {
            return redirect()->route('dashboard')->with('error', 'Anda belum menjadi Mitra resmi.');
        }

        $lapangans = Lapangan::where('user_id', $user->id)->get();

        $mitraBookings = Booking::whereHas('lapangan', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('lapangan')->get();
        
        $totalPendapatan = 0;
        foreach ($mitraBookings as $booking) {
            if ($booking->status == 'confirmed') {
                try {
                    $jamMulai = \Carbon\Carbon::parse($booking->jam_mulai);
                    $jamSelesai = \Carbon\Carbon::parse($booking->jam_selesai);
                    $durasiJam = abs($jamSelesai->diffInHours($jamMulai));
                    if ($durasiJam < 1) $durasiJam = 1; 
                    $totalPendapatan += ($booking->lapangan->harga_per_jam * $durasiJam);
                } catch (\Exception $e) { continue; }
            }
        }

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
        if (Auth::user()->role !== 'mitra') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk Mitra.');
        }
        return view('mitra.create-lapangan');
    }

    public function storeLapangan(Request $request)
    {
        if (Auth::user()->role !== 'mitra') {
            abort(403, 'Akses ditolak. Anda tidak berhak menambah lapangan.');
        }

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
            
            // Simpan ke storage (biar konsisten)
            $path = $file->storeAs('lapangans', $filename, 'public'); 
            $gambarUrl = asset('storage/lapangans/' . $filename);
        }

        Lapangan::create([
            'user_id' => Auth::id(),
            'nama_lapangan' => $request->nama_lapangan,
            'jenis' => $request->jenis,
            'lokasi' => $request->lokasi,
            'harga_per_jam' => $request->harga_per_jam,
            'rating' => 0,
            'gambar_url' => $gambarUrl,
        ]);

        return redirect()->route('mitra.index')->with('success', 'Lapangan baru berhasil ditambahkan!');
    }

    public function updateLapangan(Request $request, Lapangan $lapangan)
    {
        // Pengecekan Longgar (!=) biar tidak error beda tipe data
        if ($lapangan->user_id != Auth::id()) {
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
            
            // Hapus gambar lama (opsional)
            if ($lapangan->gambar_url) {
                $oldPath = str_replace(asset('storage/'), '', $lapangan->gambar_url);
                Storage::disk('public')->delete($oldPath);
            }

            $file->storeAs('lapangans', $filename, 'public');
            $dataUpdate['gambar_url'] = asset('storage/lapangans/' . $filename);
        }

        $lapangan->update($dataUpdate);
        return redirect()->route('mitra.index')->with('success', 'Data lapangan berhasil diperbarui!');
    }

    public function destroy(Lapangan $lapangan)
    {
        // Pengecekan Longgar (!=)
        if ($lapangan->user_id != Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'ANDA TIDAK BERHAK MENGHAPUS LAPANGAN INI.');
        }

        if ($lapangan->gambar_url) {
            $oldPath = str_replace(asset('storage/'), '', $lapangan->gambar_url);
            Storage::disk('public')->delete($oldPath);
        }

        $lapangan->delete();

        if (Auth::user()->is_admin) {
            return redirect()->route('super.dashboard')->with('success', 'Lapangan berhasil dihapus oleh Admin.');
        }

        return redirect()->route('mitra.index')->with('success', 'Lapangan berhasil dihapus.');
    }

    public function editLapangan(Lapangan $lapangan)
    {
        // Pengecekan Longgar (!=)
        if ($lapangan->user_id != Auth::id()) {
            abort(403);
        }

        return view('mitra.edit-lapangan', [
            'lapangan' => $lapangan
        ]);
    }

    // --- REKENING ---
    public function indexRekening()
    {
        $rekenings = \App\Models\Rekening::where('user_id', Auth::id())->get();
        return view('mitra.rekening', ['rekenings' => $rekenings]);
    }

    public function storeRekening(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required|string|max:50',
            'nomor_rekening' => 'required|numeric',
            'atas_nama' => 'required|string|max:100',
        ]);

        \App\Models\Rekening::create([
            'user_id' => Auth::id(),
            'nama_bank' => $request->nama_bank,
            'nomor_rekening' => $request->nomor_rekening,
            'atas_nama' => $request->atas_nama,
        ]);

        return back()->with('success', 'Rekening berhasil ditambahkan!');
    }

    public function destroyRekening($id)
    {
        $rekening = \App\Models\Rekening::findOrFail($id);
        
        if ($rekening->user_id != Auth::id()) {
            abort(403);
        }

        $rekening->delete();
        return back()->with('success', 'Rekening berhasil dihapus.');
    }
    
    public function checkUpdates()
    {
        $user = Auth::user();
        
        // Ambil data statistik ringkas saja
        $mitraBookings = \App\Models\Booking::whereHas('lapangan', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        $data = [
            'total_pendapatan' => $mitraBookings->where('status', 'confirmed')->sum(function ($booking) {
                $durasi = \Carbon\Carbon::parse($booking->jam_mulai)->diffInHours(\Carbon\Carbon::parse($booking->jam_selesai));
                // Handle durasi 0 jika booking < 1 jam (opsional, sesuaikan logika Anda)
                return $booking->lapangan->harga_per_jam * ($durasi ?: 1);
            }),
            'order_pending' => $mitraBookings->where('status', 'pending')->count(),
            'total_order' => $mitraBookings->count(),
        ];

        return response()->json($data);
    }
}