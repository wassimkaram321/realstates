<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasFactory, HasTranslations;
    public $timestamps = false;
    public $translatable  = ['title'];
    protected $fillable = [
        'id',
        'title'
    ];

    public function realstates()
    {
        return $this->belongsToMany(RealState::class, 'real_state_tags');
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'vehicle_tags', 'tag_id', 'vehicle_id');
    }

    public function toArray()
    {
        if (request()->routeIs('tag_details')) {
            return parent::toArray();
        }

        $attributes = [];
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale());
        }
        return $attributes;
    }
}
