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
        $request->validate([
            'lapangan_id' => 'required|exists:lapangans,id',
            'user_id' => 'required|exists:users,id',
            'tanggal_booking' => 'required|date',
        ]);

        Booking::create([
            'user_id' => $request->user_id,
            'lapangan_id' => $request->lapangan_id,
            'tanggal_booking' => $request->tanggal_booking,
            'jam_mulai' => '00:00:00',
            'jam_selesai' => '00:00:00',
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking berhasil dibuat!');
    }
}