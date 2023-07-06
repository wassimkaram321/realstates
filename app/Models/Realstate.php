<?php

namespace App\Models;

use Digikraaft\ReviewRating\Traits\HasReviewRating;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Spatie\Translatable\HasTranslations;

class Realstate extends Model
{
    use HasFactory, HasTranslations;
    protected $table = 'real_states';
    public $translatable  = ['name', 'description'];

    protected $fillable = [
        'name',
        'description',
        'price',
        'space',
        'slug',
        'child_id',
        'sub_id',
        'latitude',
        'longtitude',
        'cat_id',
        'city_id',
        'cat_type',
        'user_id',
        'package_id',
        'image',
        'status',
        'feature',
        'Recommended',
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
        return $this->belongsToMany(Attribute::class, 'realestate_attributes', 'realestate_id', 'attribute_id')
            ->withPivot('selected_value');
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'real_state_tags');
    }
    // public function category()
    // {
    //     return $this->morphTo('cat');
    // }
    public function category()
    {
        return $this->belongsTo(categories::class, 'cat_id');
    }
    public function categories()
    {
        return $this->belongsTo(categories::class, 'cat_id');
    }
    public function sub()
    {
        return $this->belongsTo(sub_categories::class, 'sub_id');
    }
    public function child()
    {
        return $this->belongsTo(Childcategory::class, 'child_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function realsestate_booking()
    {
        return $this->hasMany(Realestat_booking::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'favorite_realestate', 'realestate_id', 'user_id');
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'realestate_attributes', 'realestate_id', 'selected_value')
            ->withPivot('selected_value');
    }


    public function toArray()
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale() ?? 'en');
        }
        return $attributes;
    }

    public function scopeApp($query)
    {
        $newQuery = $query->get();

        $user = User::where('id', Auth::guard('api')->id())->first();

        foreach ($newQuery as $realestate) {

            $realestate->favorite_status = 0;
            if (isset($user)) {
                $fav  = $user->favoriteRealEstates()->where('realestate_id', $realestate->id)->first();
                if (isset($fav)) {
                    $realestate->favorite_status = 1;
                }
            }
        }
        return $newQuery;
    }
}
