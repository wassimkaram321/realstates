<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;


class Package extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable  = ['name', 'description'];
    protected $fillable = ['id', 'name', 'description', 'is_active', 'price', 'deuration', 'color', 'parent_id'];

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'package_features', 'package_id', 'featur_id')->withPivot(['feature_value']);
    }
    public function parent()
    {
        return $this->belongsTo(Package::class, 'parent_id')->with('parent');
    }
    
    public function child()
    {
        return $this->belongsTo(Package::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class,'package_users','package_id','user_id');
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function toArray()
    {
        if (request()->routeIs('edit_package')) {
            return parent::toArray();
        }

        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale());
        }
        return $attributes;
    }
}
