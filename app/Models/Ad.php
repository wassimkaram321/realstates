<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory ;
    public $timestamps = true;
    protected $fillable = [
        'start_date',
        'end_date',
        'priority',
        'url',
        'click_count',
        'is_active',
        'category_id',
        'package_id',
        'image',
    ];
    public function category()
    {
        return $this->belongsTo(AdCategory::class, 'category_id');
    }
    public function package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }
    public static function booted()
    {
        static::retrieved(function ($ad) {
            $ad->image = asset('images/ADS/' . $ad->image);
        });
        // static::updating(function ($ad) {
        //     if($ad->image){
        //         $ad->image = basename($ad->image);
        //     }
        // });
    }
}
