<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Realstate extends Model
{
    use HasFactory,HasTranslations;
    protected $table = 'real_states';
    public $translatable  = ['name','description'];

    protected $fillable = [
        'name',
        'description',
        'price',
        'space',
        'slug',
        'latitude',
        'longitude',
        'cat_id',
        'cat_type',
        'user_id',
        'image',
        'status',
        'tags',
        'attributes',
        'images',
        'address',
        'rent_time',
        'ava',
    ];
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeAva($query)
    {
        return $query->where('ava', 1);
    }
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'real_state_tags');
    }
    public function category()
    {
        return $this->morphTo('cat');
    }
    public function city()
    {
        return $this->hasOne('city_id');
    }
}
