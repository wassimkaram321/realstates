<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasFactory, HasTranslations;
    public $translatable  = ['title'];
    protected $fillable = [
        'title', 'icon','adcategory_id'
    ];
    public $withCount = ['realstate'];
    public function realstate()
    {
        return $this->belongsToMany(Realstate::class, 'realestate_attributes', 'attribute_id', 'realestate_id');
    }
    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'vehicles_attributes', 'attribute_id', 'vehicle_id');
    }
    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
    public function type()
    {
        return $this->belongsTo(AdCategory::class,'adcategory_id');
    }

    public function toArray()
    {
        if (request()->routeIs('attribute')) {
            return parent::toArray();
        }

        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale());
        }
        return $attributes;
    }

    public static function booted()
    {
        static::retrieved(function ($category) {
            $category->icon = asset('images/attributes/' . $category->icon);
        });
        static::updating(function ($category) {
            if ($category->icon) {
                $category->icon = basename($category->icon);
            }
        });
    }
}
