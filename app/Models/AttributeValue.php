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
    public $with = 'attribute';

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
    public function toArray()
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale() ?? 'en');
        }
        return $attributes;
    }
    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'realestate_attributes','value_id','realestate_id');
    }
}
