<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'train_id',
        'route_name',
        'departure_station',
        'arrival_station',
        'departure_time',
        'arrival_time',
        'schedule_date',
        'status',
        'days_of_operation',
        'delay_minutes',
        'notes'
    ];

    /**
     * Get the train that owns the schedule.
     */
    public function train()
    {
        return $this->belongsTo(Train::class);
    }

    /**
     * Scope a query to only include schedules with a specific status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include schedules for specific days.
     */
    public function scopeDaysOfOperation($query, $days)
    {
        return $query->where('days_of_operation', $days);
    }

    /**
     * Scope a query to only include schedules for a specific date range.
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('schedule_date', [$startDate, $endDate]);
    }
}
