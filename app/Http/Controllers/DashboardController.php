<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Lapangan;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $myBookings = Booking::where('user_id', $user->id)
                            ->with('lapangan')
                            ->latest()
                            ->get();

        $mitraVenues = [];
        $incomingOrders = [];

        if ($user->role === 'mitra' || $user->is_admin) {
            $mitraVenues = Lapangan::where('user_id', $user->id)->get();

            $incomingOrders = Booking::whereHas('lapangan', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with(['user', 'lapangan'])->latest()->get();
        }

        return view('dashboard', [
            'user' => $user,
            'myBookings' => $myBookings,
            'mitraVenues' => $mitraVenues,
            'incomingOrders' => $incomingOrders,
        ]);
    }
}