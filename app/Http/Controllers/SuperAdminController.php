<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lapangan;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class SuperAdminController extends Controller
{
    
    public function index()
    {
        $totalUser = User::where('role', 'user')->count();
        $totalMitra = User::where('role', 'mitra')->count();
        $totalLapangan = Lapangan::count();
        $totalBooking = Booking::count();

        $allUsers = User::latest()->paginate(5, ['*'], 'users_page');

        $allVenues = Lapangan::with('user')->latest()->paginate(5, ['*'], 'venues_page');

        return view('superadmin.dashboard', [
            'totalUser' => $totalUser,
            'totalMitra' => $totalMitra,
            'totalLapangan' => $totalLapangan,
            'totalBooking' => $totalBooking,
            'allUsers' => $allUsers,
            'allVenues' => $allVenues,
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus dari sistem.');
    }
}