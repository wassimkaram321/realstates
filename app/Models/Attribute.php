<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasFactory,HasTranslations;
    public $translatable  = ['title','content'];
    protected $fillable = [
        'title','content','real_state_id'
    ];
    public function realstate()
    {
        return $this->belongsTo(Realstate::class);
    }
}
