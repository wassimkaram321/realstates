<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class Vehicle extends Model
{
    use HasFactory, HasTranslations;

    protected $table = 'vehicles';

    public $translatable  = ['name', 'description'];

    protected $fillable = [
        'name', 'description', 'user_id', 'cat_id', 'sub_id', 'child_id', 'package_id', 'rent_id',
        'price', 'image', 'slug', 'latitude', 'longtitude', 'status',
        'feature', 'Recommended', 'year', 'km', 'ava',
    ];

    public function toArray()
    {
        // if (request()->routeIs('edit_package')) {
        //     return parent::toArray();
        // }

        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale());
        }
        return $attributes;
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function category()
    {
        return $this->belongsTo(VehicleCategory::class, 'cat_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(VehicleSubcategory::class, 'sub_id');
    }

    public function childcategory()
    {
        return $this->belongsTo(VehicleChildcategory::class, 'child_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'vehicle_tags', 'vehicle_id', 'tag_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
  
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'vehicles_attributes', 'vehicle_id', 'attribute_id')
            ->withPivot('selected_value');
    }
    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'vehicles_attributes', 'vehicle_id', 'selected_value')
            ->withPivot('selected_value');
    }

}
