<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class Childcategory extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable  = ['name'];
    protected $fillable = ['id','sub_id','name'];

    public function sub()
    {
        return $this->belongsTo(sub_categories::class, 'sub_id');
    }

    public function realstates()
    {
        return $this->hasManyThrough(Realstate::class, Childcategory::class, 'id', 'cat_id')->where('cat_type', Childcategory::class);
    }
    public function realestate()
    {
        return $this->hasMany(Realstate::class,'child_id');
    }

    public function toArray()
    {
        if (request()->routeIs('edit_child')) {
            return parent::toArray();
        }
    
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale());
        }
        return $attributes;
    }

}
