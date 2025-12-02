<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking; // PENTING: Import model Booking

class BookingStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $booking; // Variabel ini akan membawa data booking ke email

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function envelope(): Envelope
    {
        // Judul Email otomatis berubah sesuai status
        $statusIndo = $this->booking->status == 'confirmed' ? 'Dikonfirmasi' : 'Dibatalkan';
        
        return new Envelope(
            subject: 'Status Booking #' . $this->booking->id . ': ' . $statusIndo,
        );
    }

    public function content(): Content
    {
        // Mengarah ke file tampilan email (yang akan kita buat di Langkah 3)
        return new Content(
            view: 'emails.booking-status', 
        );
    }

    public function attachments(): array
    {
        return [];
    }
}