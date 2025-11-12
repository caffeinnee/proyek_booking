<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Lapangan;
use App\Http\Controllers\BookingController;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    $lapangans = Lapangan::all();
    return view('welcome', [
        'lapangans' => $lapangans
    ]);
})->name('welcome');

Route::get('/dashboard', function () {
    $myBookings = Booking::where('user_id', Auth::id())
                        ->with('lapangan')
                        ->orderBy('tanggal_booking', 'desc')
                        ->get();

    return view('dashboard', [
        'myBookings' => $myBookings,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/booking/create/{lapangan}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
});

require __DIR__.'/auth.php';
