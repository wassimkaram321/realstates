<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\HasTranslations;

class sub_categories extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable  = ['name'];
    protected $fillable = ['id','cat_id','name'];

    // public function category()
    // {
    //     return $this->belongsTo(categories::class, 'cat_id');
    // }
    public function child()
    {
        return $this->hasMany(Childcategory::class);
    }

    public function realstates()
    {
        return $this->hasManyThrough(Realstate::class, sub_categories::class, 'id', 'cat_id')->where('cat_type', sub_categories::class);
    }
    public function realestate()
    {
        return $this->hasMany(Realstate::class,'sub_id');
    }
    
    public function toArray()
    {
        if (request()->routeIs('edit_sub')) {
            return parent::toArray();
        }
    
        $attributes = [];
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale());
        }
        return $attributes;
    }

}
