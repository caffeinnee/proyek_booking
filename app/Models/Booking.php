<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lapangan; 

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'lapangan_id',
        'tanggal_booking',
        'jam_mulai',
        'jam_selesai',
    ];

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class);
    }
}