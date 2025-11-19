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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/katalog', function (Request $request) {
    $query = Lapangan::query();
    $searchTerm = $request->input('search');
    if ($searchTerm) {
        $query->where('nama_lapangan', 'like', '%' . $searchTerm . '%')
              ->orWhere('jenis', 'like', '%' . $searchTerm . '%');
    }
    $lapangans = $query->get();
    return view('katalog', [
        'lapangans' => $lapangans,
        'searchTerm' => $searchTerm
    ]);
})->name('katalog');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

Route::get('/admin/bookings/{booking}', [AdminController::class, 'showBooking'])
    ->middleware(['auth', 'admin'])
    ->name('admin.booking.show');

Route::post('/admin/bookings/{booking}/confirm', [AdminController::class, 'confirmBooking'])
    ->middleware(['auth', 'admin'])
    ->name('admin.booking.confirm');

Route::post('/admin/bookings/{booking}/cancel', [AdminController::class, 'cancelBooking'])
    ->middleware(['auth', 'admin'])
    ->name('admin.booking.cancel');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/booking/create/{lapangan}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    
    Route::get('/mitra/daftar', [MitraController::class, 'create'])->name('mitra.create');
    Route::post('/mitra/simpan', [MitraController::class, 'store'])->name('mitra.store');
    Route::get('/mitra/dashboard', [MitraController::class, 'index'])->name('mitra.index');

    Route::get('/mitra/lapangan/baru', [MitraController::class, 'createLapangan'])->name('mitra.lapangan.create');
    Route::post('/mitra/lapangan/simpan', [MitraController::class, 'storeLapangan'])->name('mitra.lapangan.store');
    
    Route::delete('/mitra/hapus/{lapangan}', [MitraController::class, 'destroy'])->name('mitra.destroy');
});

require __DIR__.'/auth.php';