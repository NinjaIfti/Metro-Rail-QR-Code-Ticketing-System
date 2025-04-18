<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'ticket_number',
        'from_station',
        'to_station',
        'journey_date',
        'departure_time',
        'arrival_time',
        'number_of_passengers',
        'fare',
        'qr_code',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'journey_date' => 'datetime',
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
        'fare' => 'decimal:2',
    ];

    /**
     * Get the user that owns the ticket.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate a unique ticket number.
     */
    public static function generateTicketNumber()
    {
        $prefix = 'MTR';
        $randomNumber = mt_rand(100000, 999999);
        $ticketNumber = $prefix . $randomNumber;

        // Check if the ticket number already exists
        while (self::where('ticket_number', $ticketNumber)->exists()) {
            $randomNumber = mt_rand(100000, 999999);
            $ticketNumber = $prefix . $randomNumber;
        }

        return $ticketNumber;
    }
}
