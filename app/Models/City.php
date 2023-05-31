<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable  = ['name'];
    protected $fillable = ['id','state_id','name'];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function real_states()
    {
        return $this->hasMany(Realstate::class);
    }
    public function toArray()
    {
        if (request()->routeIs('edit_city')) {
            return parent::toArray();
        }
    
        $attributes = [];
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale());
        }
        return $attributes;
    }
}
