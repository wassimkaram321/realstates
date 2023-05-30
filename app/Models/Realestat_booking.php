<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realestat_booking extends Model
{
    use HasFactory;
    protected $table = 'realestat_bookings';

    protected $fillable = [
        'request_id',
        'user_id',
        'realestate_id',
        'booking_type',
        'id',

    ];
    public function realestate()
    {
        return $this->belongsTo(Realstate::class, 'realestate_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category()
    {
        return $this->belongsTo(categories::class, 'booking_type');
    }
}
