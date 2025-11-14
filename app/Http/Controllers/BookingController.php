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
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran.');
    }
}