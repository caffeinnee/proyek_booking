<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lapangan;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SuperAdminController extends Controller
{
    // Fungsi bantuan untuk cek akses
    private function checkAccess()
    {
        if (Auth::user()->role !== 'admin' && !Auth::user()->is_admin) {
            abort(403, 'AKSES DITOLAK: Halaman ini khusus Super Admin.');
        }
    }

    public function index()
    {
        $this->checkAccess();

        $totalUser = User::where('role', 'user')->count();
        $totalMitra = User::where('role', 'mitra')->count();
        $totalLapangan = Lapangan::count();
        $totalBooking = Booking::count();

        $allUsers = User::latest()->paginate(5, ['*'], 'users_page');
        $allVenues = Lapangan::with('user')->latest()->paginate(5, ['*'], 'venues_page');
        $pendingMitras = User::where('status_mitra', 'pending')->latest()->get();

        return view('superadmin.dashboard', [
            'totalUser' => $totalUser,
            'totalMitra' => $totalMitra,
            'totalLapangan' => $totalLapangan,
            'totalBooking' => $totalBooking,
            'allUsers' => $allUsers,
            'allVenues' => $allVenues,
            'pendingMitras' => $pendingMitras,
        ]);
    }

    public function show(User $user)
    {
        $this->checkAccess();
        return view('superadmin.mitra-detail', ['mitra' => $user]);
    }

    public function approveMitra(User $user)
    {
        $this->checkAccess();
        $user->update(['role' => 'mitra', 'status_mitra' => 'approved']);
        return redirect()->route('super.dashboard')->with('success', 'Pengajuan mitra diterima!');
    }

    public function rejectMitra(User $user)
    {
        $this->checkAccess();
        $user->update(['status_mitra' => 'rejected']);
        return redirect()->route('super.dashboard')->with('success', 'Pengajuan mitra ditolak.');
    }

    public function destroy($id)
    {
        $this->checkAccess();
        $user = User::findOrFail($id);
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }

    public function createAdmin()
    {
        $this->checkAccess();
        return view('superadmin.create-admin');
    }

    public function storeAdmin(Request $request)
    {
        $this->checkAccess();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true,
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        return redirect()->route('super.dashboard')->with('success', 'Admin baru berhasil ditambahkan!');
    }

    public function toggleVerified(User $user)
    {
        $this->checkAccess();

        $user->update([
            'is_verified' => !$user->is_verified
        ]);

        $status = $user->is_verified ? 'VERIFIED (Centang Biru)' : 'UNVERIFIED';
        return back()->with('success', "Status user berhasil diubah menjadi: $status");
    }

    public function toggleFeatured(Lapangan $lapangan)
    {
        $this->checkAccess();

        $lapangan->update([
            'is_featured' => !$lapangan->is_featured
        ]);

        $status = $lapangan->is_featured ? 'FEATURED (Iklan Aktif)' : 'REGULER (Iklan Mati)';
        return back()->with('success', "Status lapangan berhasil diubah menjadi: $status");
    }
}