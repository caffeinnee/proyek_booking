<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $bookingsQuery = Booking::with('user', 'lapangan')->latest();

        if ($user->is_admin) {
        } else {
            $bookingsQuery->whereHas('lapangan', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        $bookings = $bookingsQuery->get();
        
        return view('admin.dashboard', [
            'bookings' => $bookings
        ]);
    }

    public function showBooking(Booking $booking)
    {
        $booking->load('user', 'lapangan');

        return view('admin.booking-detail', [
            'booking' => $booking
        ]);
    }

    public function confirmBooking(Booking $booking)
    {
        $booking->status = 'confirmed';
        $booking->save();

        return redirect()->route('admin.booking.show', $booking)->with('success', 'Booking berhasil dikonfirmasi (Lunas)!');
    }

    public function cancelBooking(Booking $booking)
    {
        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->route('admin.booking.show', $booking)->with('success', 'Booking berhasil dibatalkan.');
    }
}
