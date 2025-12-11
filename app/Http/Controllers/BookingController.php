<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Booking;

class BookingController extends Controller
{

    public function create(Lapangan $lapangan)
    {
        return view('booking.create', [
            'lapangan' => $lapangan
        ]);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'lapangan_id' => 'required|exists:lapangans,id',
            'user_id' => 'required|exists:users,id',
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s|after:jam_mulai',
        ]);

        $isOccupied = Booking::where('lapangan_id', $validated['lapangan_id'])
                            ->where('tanggal_booking', $validated['tanggal_booking'])
                            ->where(function ($query) use ($validated) {
                                $query->where('jam_mulai', '<', $validated['jam_selesai'])
                                      ->where('jam_selesai', '>', $validated['jam_mulai']);
                            })
                            ->whereIn('status', ['pending', 'confirmed'])
                            ->exists();

        if ($isOccupied) {
            return back()
                ->withInput()
                ->with('error', 'Jadwal yang Anda pilih sudah dipesan orang lain. Silakan pilih jam lain.');
        }

        Booking::create([
            'user_id' => $validated['user_id'],
            'lapangan_id' => $validated['lapangan_id'],
            'tanggal_booking' => $validated['tanggal_booking'],
            'jam_mulai' => $validated['jam_mulai'],
            'jam_selesai' => $validated['jam_selesai'],
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran.');
    }

    public function showPayment(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('booking.payment', ['booking' => $booking]);
    }

    public function uploadPayment(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            $filename = time() . '_bukti_' . $booking->id . '.' . $file->getClientOriginalExtension();
            
            $file->move(public_path('images/bukti_bayar'), $filename);
            
            $booking->update([
                'bukti_bayar' => 'images/bukti_bayar/' . $filename,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Bukti pembayaran berhasil diunggah! Tunggu konfirmasi admin.');
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->status !== 'pending') {
            return redirect()->back()->with('error', 'Pesanan yang sudah diproses tidak bisa dibatalkan otomatis.');
        }

        $booking->update([
            'status' => 'cancelled'
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('booking.show', compact('booking'));
    }
    
}