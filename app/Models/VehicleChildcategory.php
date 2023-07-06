<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class VehicleChildcategory extends Model
{
    use HasFactory;
    protected $table = 'vehicle_childcategories';
    protected $fillable = [
        'id',
        'name',
        'sub_id',
    ];


    public function sub()
    {
        return $this->belongsTo(VehicleSubcategory::class, 'sub_id');
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

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);

    }
}
