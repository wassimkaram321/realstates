<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','alt','real_state_id'
    ];
    public function realstate()
    {
        return $this->belongsTo(Realstate::class);
    }
}
