<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\App; 
class categories extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable  = ['name'];
    protected $fillable = ['id', 'name'];

    public function toArray()
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale());
        }
        return $attributes;
    }

    public function sub_categories()
    {
        return $this->hasMany(sub_categories::class);
    }

    
    public function realstates()
    {
        return $this->hasManyThrough(Realstate::class, categories::class, 'id', 'cat_id')->where('cat_type', categories::class);
        
       
    }
}
