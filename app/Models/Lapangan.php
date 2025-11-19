<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Booking;

class Lapangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',        
        'nama_lapangan',
        'jenis',
        'harga_per_jam',
        'gambar_url',
        'lokasi',
        'rating',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}