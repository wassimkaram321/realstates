<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class VehicleSubcategory extends Model
{
    use HasFactory;
    protected $table = 'vehicle_subcategories';
    protected $fillable = [
        'id',
        'name',
        'icone',
    ];
    public function cat()
    {
        return $this->belongsToMany(VehicleCategory::class, 'vehicle_categories_subcategories', 'cat_id', 'sub_id');
    }
    public function child()
    {
        return $this->hasMany(VehicleChildcategory::class);
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
