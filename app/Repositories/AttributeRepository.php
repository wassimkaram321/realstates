<?php

namespace App\Repositories;

use App\Manager\AttributeManager;
use App\Models\Attribute;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Spatie\Permission\Models\Role;

//use Your Model

/**
 * Class userRepository.
 */
class AttributeRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $attribute;
    protected $attributeManager;

    public function __construct(Attribute $attribute , AttributeManager $attributeManager)
    {
        $this->attribute = $attribute;
        $this->attributeManager = $attributeManager;
    }
    public function all($request)
    {
        # code...
        App::setlocale($request->lang);
        return $this->attribute->all();
    }
    public function find($id)
    {
        return $this->attribute->whereid($id)->get();
    }
    public function create($request)
    {
        # code...
        $attributes = $this->attribute->create($request->all());
        $this->attributeManager->setTranslation($attributes,$request);
        return $attributes;
    }
    public function update($request)
    {
        $attributes =  $this->attribute->find($request->id);
        $attributes->update($request->all());
        $this->attributeManager->setTranslation($attributes,$request);
        return $attributes;
    }
    public function delete($request)
    {
        return $this->attribute->destroy($request->id);
    }



}
