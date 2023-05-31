<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
// use Spatie\Translatable\HasTranslations;

class Request extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'requests';

    protected $fillable = [
        'user_id',
        'bookedup_id',
        'status',
        'type',
      
    ];
    // public function toArray()
    // {
    //     $attributes = parent::toArray();
    //     foreach ($this->getTranslatableAttributes() as $field) {
    //         $attributes[$field] = $this->getTranslation($field, App::getLocale());
    //     }
    //     return $attributes;
    // }
}
