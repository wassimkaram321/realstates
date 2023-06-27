<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'real_state_id',
        'comapany_id',
        'city_id',
        'phone',
        'device_id',
        'status',
        'image',
        'device_token',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
    public function real_states()
    {
        return $this->hasMany('App\Models\RealState');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function realsestate_booking()
    {
        return $this->hasMany(Realestat_booking::class);
    }
    public function Package()
    {
        return $this->belongsToMany(Package::class);
    }
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    // many to many
    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'user_notification', 'user_id', 'notification_id')
            ->withPivot(['seen', 'seen_at'])->orderBy('created_at', 'desc');
    }

    public function favoriteRealEstates()
    {
        return $this->belongsToMany(Realstate::class, 'favorite_realestate', 'user_id', 'realestate_id')
            ->where('status', 1);
    }
}
