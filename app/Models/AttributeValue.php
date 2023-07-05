<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class AttributeValue extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable  = ['value'];
    public $table = 'attribute_values';
    protected $fillable = ['attribute_id','value'];
    public $withCount = ['realestates'];
    // public $with = 'attribute';

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
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
    public function attributeValues()
    {
        return $this->belongsToMany(Attribute::class, 'realestate_attributes','attribute_id','realestate_id');
    }
    public function realestates()
    {
        return $this->belongsToMany(Realstate::class, 'realestate_attributes','selected_value','realestate_id');
    }
}
