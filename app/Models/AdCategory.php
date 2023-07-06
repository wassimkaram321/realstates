<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class AdCategory extends Model
{
    use HasFactory ,HasTranslations;
    public $timestamps = true;
    public $table  = 'ad_categories';
    public $translatable  = ['name'];
    protected $fillable = [
        'name'
    ];
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
    public function toArray()
    {


        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale());
        }
        return $attributes;
    }
    public static function booted()
    {

        static::retrieved(function ($category) {
            $category->image = asset('images/categories/'.$category->image);
            $category->thumbnail = asset('images/categories/'.$category->thumbnail);
        });
        static::updating(function ($category) {
            if($category->image){
                $category->image = basename($category->image);
            }
        });
    }


}
