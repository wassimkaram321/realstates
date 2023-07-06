<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;


class VehicleCategory extends Model
{
    use HasFactory,HasTranslations;

    protected $table = 'vehicle_categories';
    public $translatable  = ['name'];
    protected $fillable = [
        'id',
        'name',
        'icon',
    ];
    public function sub()
    {
        return $this->belongsToMany(VehicleSubcategory::class, 'vehicle_categories_subcategories', 'cat_id', 'sub_id');
    }
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

    public static function booted()
    {
        static::retrieved(function ($cat) {
            $cat->icon = asset('images/car_images/icon/' . $cat->icon);
        });
        static::updating(function ($cat) {
            if($cat->icon){
                $cat->icon = basename($cat->icon);
            }
        });
    }
}
