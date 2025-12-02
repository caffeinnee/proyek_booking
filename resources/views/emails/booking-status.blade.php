<!DOCTYPE html>
<html>
<head>
    <title>Update Status Booking</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">

    <h2 style="color: #d32f2f;">Halo, {{ $booking->user->name }}!</h2>

    <p>Status pemesanan lapangan Anda telah diperbarui.</p>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr style="background-color: #f2f2f2;">
            <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">Lapangan</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $booking->lapangan->nama_lapangan }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">Tanggal</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}</td>
        </tr>
        <tr style="background-color: #f2f2f2;">
            <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">Jam</td>
            <td style="padding: 10px; border: 1px solid #ddd;">
                {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - 
                {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}
            </td>
        </tr>
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">STATUS</td>
            <td style="padding: 10px; border: 1px solid #ddd;">
                @if($booking->status == 'confirmed')
                    <span style="color: green; font-weight: bold; font-size: 1.2em;">LUNAS / DIKONFIRMASI</span>
                @else
                    <span style="color: red; font-weight: bold; font-size: 1.2em;">DIBATALKAN</span>
                @endif
            </td>
        </tr>
    </table>

    <p>Silakan login ke aplikasi untuk melihat detail lengkapnya.</p>
    <p>Terima kasih,<br><strong>Admin Booking Lapangan</strong></p>

</body>
</html>