<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingStatusUpdate;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        if ($user->is_admin) {
            return redirect()->route('super.dashboard')->with('error', 'Halaman Kelola Orderan hanya untuk Mitra.');
        }

        $bookings = Booking::with('user', 'lapangan')
            ->whereHas('lapangan', function ($query) use ($user) {
                $query->where('user_id', $user->id); 
            })
            ->latest()
            ->get();
        
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
        $booking->update(['status' => 'confirmed']);

        try {
            Mail::to($booking->user->email)->send(new BookingStatusUpdate($booking));
        } catch (\Exception $e) {
            
        }

        return redirect()->back()->with('success', 'Booking berhasil dikonfirmasi (Lunas) & Notifikasi dikirim!');
    }

    public function cancelBooking(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);

        try {
            Mail::to($booking->user->email)->send(new BookingStatusUpdate($booking));
        } catch (\Exception $e) {
        }

        return redirect()->back()->with('success', 'Booking berhasil dibatalkan & Notifikasi dikirim!');
    }
}