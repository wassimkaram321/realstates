<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class categories extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable  = ['name'];
    protected $fillable = ['id', 'name'];

    public function sub_categories()
    {
        return $this->hasMany(sub_categories::class);
    }

    
    public function realstates()
    {
        return $this->hasManyThrough(Realstate::class, categories::class, 'id', 'cat_id')->where('cat_type', categories::class);
        
       
    }
}