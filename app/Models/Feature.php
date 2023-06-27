<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class Feature extends Model
{
    use HasFactory, HasTranslations;
    public $translatable  = ['name'];
    protected $fillable = ['id', 'name'];

    public function package()
    {
        return $this->belongsToMany(Package::class, 'package_features', 'package_id', 'featur_id');
    }
    public function toArray()
    {
        $attributes = [];
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale());
        }
        return $attributes;
    }
}
