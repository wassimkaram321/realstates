<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class sub_categories extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable  = ['name'];
    protected $fillable = ['id','cat_id','name'];

    public function category()
    {
        return $this->belongsTo(categories::class, 'cat_id');
    }
    public function child()
    {
        return $this->hasMany(Childcategory::class);
    }
}
