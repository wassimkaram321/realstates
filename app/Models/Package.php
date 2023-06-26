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

    public $translatable  = ['name','description'];
    protected $fillable = ['id','name','description','is_active','price','start_date','end_date'];

    public function toArray()
    {
        if (request()->routeIs('edit_package')) {
            return parent::toArray();
        }
    
        $attributes = [];
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, App::getLocale());
        }
        return $attributes;
    }
}
