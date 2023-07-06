<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table = 'vehicles';
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'vehicles_attributes', 'vehicle_id', 'attribute_id')
            ->withPivot('selected_value');
    }
    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'vehicles_attributes', 'vehicle_id', 'selected_value')
            ->withPivot('selected_value');
    }


}
