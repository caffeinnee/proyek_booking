<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Lapangan;
use App\Http\Controllers\BookingController;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdminController;
// HAPUS PageController karena kita pakai fungsi langsung di sini biar praktis

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// --- HALAMAN STATIS (Cara Pesan & Tentang Kami) ---
// Menggunakan function() agar tidak perlu bikin Controller baru
Route::get('/cara-pesan', function () {
    return view('pages.cara-pesan');
})->name('cara-pesan');

Route::get('/tentang-kami', function () {
    return view('pages.tentang-kami');
})->name('tentang-kami');


Route::get('/katalog', function (Request $request) {
    $query = Lapangan::query();
    $searchTerm = $request->input('search');

    if ($searchTerm) {
        $query->where('nama_lapangan', 'like', '%' . $searchTerm . '%')
              ->orWhere('jenis', 'like', '%' . $searchTerm . '%');
    }

    $lapangans = $query->orderBy('is_featured', 'desc')
                       ->latest()
                       ->get();
    
    return view('katalog', [
        'lapangans' => $lapangans,
        'searchTerm' => $searchTerm
    ]);
})->name('katalog');

// --- RUTE DARURAT STORAGE (Bisa dihapus nanti jika sudah fix) ---
Route::get('/fix-storage', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');
    try {
        if (file_exists($link) || is_link($link)) {
            @unlink($link);
            @rmdir($link); 
            \Illuminate\Support\Facades\File::deleteDirectory($link);
        }
        if (file_exists($link)) {
            return "GAGAL: Folder storage masih ada. Hapus manual di cPanel.";
        }
        symlink($target, $link);
        return "SUKSES: Symlink berhasil diperbaiki.";
    } catch (\Exception $e) {
        return "ERROR: " . $e->getMessage();
    }
});


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// --- ADMIN ROUTES ---
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

Route::get('/admin/bookings/{booking}', [AdminController::class, 'showBooking'])
    ->middleware(['auth', 'admin'])
    ->name('admin.booking.show');

// PENTING: Menggunakan PATCH sesuai form di view
Route::patch('/admin/bookings/{booking}/confirm', [AdminController::class, 'confirmBooking'])
    ->middleware(['auth', 'admin'])
    ->name('admin.booking.confirm');

Route::patch('/admin/bookings/{booking}/cancel', [AdminController::class, 'cancelBooking'])
    ->middleware(['auth', 'admin'])
    ->name('admin.booking.cancel');


// --- SUPER ADMIN ROUTES ---
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/super/dashboard', [SuperAdminController::class, 'index'])->name('super.dashboard');
    Route::delete('/super/users/{user}', [SuperAdminController::class, 'destroy'])->name('super.users.destroy');
    Route::patch('/super/mitra/{user}/approve', [SuperAdminController::class, 'approveMitra'])->name('super.mitra.approve');
    Route::patch('/super/mitra/{user}/reject', [SuperAdminController::class, 'rejectMitra'])->name('super.mitra.reject');
    Route::get('/super/admin/create', [SuperAdminController::class, 'createAdmin'])->name('super.admin.create');
    Route::post('/super/admin/store', [SuperAdminController::class, 'storeAdmin'])->name('super.admin.store');  
    Route::patch('/super/user/{user}/verify', [SuperAdminController::class, 'toggleVerified'])->name('super.user.verify');
    Route::patch('/super/lapangan/{lapangan}/feature', [SuperAdminController::class, 'toggleFeatured'])->name('super.lapangan.feature');
});


// --- AUTH ROUTES (USER & MITRA) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Booking
    Route::get('/booking/create/{lapangan}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    
    // Pembayaran (Perhatikan nama fungsi uploadPayment)
    Route::get('/booking/{booking}/bayar', [BookingController::class, 'showPayment'])->name('booking.payment');
    Route::patch('/booking/{booking}/bayar', [BookingController::class, 'uploadPayment'])->name('booking.payment.update');
    
    Route::patch('/booking/{booking}/cancel', [BookingController::class, 'cancel'])->name('booking.user.cancel');
    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::patch('/booking/{booking}/rate', [BookingController::class, 'rate'])->name('booking.rate');

    // Mitra
    Route::get('/mitra/daftar', [MitraController::class, 'create'])->name('mitra.create');
    Route::post('/mitra/simpan', [MitraController::class, 'store'])->name('mitra.store');
    Route::get('/mitra/dashboard', [MitraController::class, 'index'])->name('mitra.index');

    Route::get('/mitra/lapangan/baru', [MitraController::class, 'createLapangan'])->name('mitra.lapangan.create');
    Route::post('/mitra/lapangan/simpan', [MitraController::class, 'storeLapangan'])->name('mitra.lapangan.store');
    Route::delete('/mitra/hapus/{lapangan}', [MitraController::class, 'destroy'])->name('mitra.destroy');
    Route::get('/mitra/lapangan/{lapangan}/edit', [MitraController::class, 'editLapangan'])->name('mitra.lapangan.edit');
    Route::put('/mitra/lapangan/{lapangan}', [MitraController::class, 'updateLapangan'])->name('mitra.lapangan.update');

    Route::get('/mitra/rekening', [MitraController::class, 'indexRekening'])->name('mitra.rekening.index');
    Route::post('/mitra/rekening', [MitraController::class, 'storeRekening'])->name('mitra.rekening.store');
    Route::delete('/mitra/rekening/{id}', [MitraController::class, 'destroyRekening'])->name('mitra.rekening.destroy');
    Route::get('/mitra/check-updates', [MitraController::class, 'checkUpdates'])->name('mitra.check.updates');
});

Route::get('/lapangan/{lapangan}', [App\Http\Controllers\LapanganController::class, 'show'])->name('lapangan.show');

require __DIR__.'/auth.php';