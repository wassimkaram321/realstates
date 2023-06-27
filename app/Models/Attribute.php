<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasFactory,HasTranslations;
    public $translatable  = ['title'];
    protected $fillable = [
        'title','icon'
    ];
    public function realstate()
    {
        return $this->belongsToMany(Realstate::class,'realestate_attributes','attribute_id','realestate_id');
    }
    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
    public function toArray()
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale() ?? 'en');
        }
        return $attributes;
    }
}
