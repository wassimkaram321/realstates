<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class sub_categories extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable  = ['id','cat_id','name'];
    protected $fillable = ['id','cat_id','name'];

    public function categories()
    {
        return $this->hasMany(categories::class);
    }
}
