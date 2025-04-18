<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    use HasFactory;

    protected $fillable = [
        'train_id',
        'name',
        'status',
        'capacity',
        'description'
    ];

    // A train has many schedules (for future implementation)
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
