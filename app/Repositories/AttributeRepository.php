<?php

namespace App\Repositories;

use App\Manager\AttributeManager;
use App\Manager\FileManager;
use App\Models\Attribute;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use PDO;
use Ramsey\Uuid\Exception\NameException;
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

    public function __construct(Attribute $attribute, AttributeManager $attributeManager)
    {
        $this->attribute = $attribute;
        $this->attributeManager = $attributeManager;
    }
    public function all($request)
    {
        App::setlocale($request->lang);
        if($request->type == 'realestates')
            return $this->attribute->where('adcategory_id',1)->with(['values', 'type'])->get();
        if($request->type == 'vehicles')
            return $this->attribute->where('adcategory_id',2)->with(['values', 'type'])->get();
            return $this->attribute->with(['values', 'type'])->get();
    }
    public function find($id)
    {
        return $this->attribute->with('values')->whereid($id)->first();
    }
    public function create($request)
    {
        # code...
        $attribute = $this->attribute->create($request->all());
        if ($request->icon != null) {
            $file_name  = (new FileManager())->addFile($request->file('icon'), 'images/attributes');
            $attribute->icon = $file_name;
            $attribute->save();
        }
        $this->attributeManager->setTranslation($attribute, $request);

        // create attribute values
        $values = $request->values ?? [];
        foreach ($values as $value) {
            $attribute->values()->create(
                [
                    'value' => $value
                ]
            );
        }


        foreach ($attribute->values() as $value) {

            $this->attributeManager->setValueTranslation($value, $request);
        }
        return $attribute;
    }
    public function update($request)
    {

        $attribute =  $this->attribute->find($request->id);
        $attribute->update($request->all());

        if($request->has('title'))
            $this->attributeManager->setTranslation($attribute, $request);


        if ($request->icon != null) {
            (new FileManager())->deleteFile($request->file('icon'), 'images/attributes');
            $file_name  = (new FileManager())->addFile($request->file('icon'), 'images/attributes');
            $attribute->icon = $file_name;
            $attribute->save();
        }

        $values = $request->values ?? [];
        $attribute->values()->whereDoesntHave('realestates')->delete();

        foreach ($values as $value) {
            $attribute->values()->create(
                [
                    'value' => $value
                ]
            );
        }
        return $attribute;
    }
    public function attributeValues($request)
    {
        return $this->attribute->with('values')->findOrFail($request->id);
    }
    public function delete($request)
    {
        $attribute = $this->attribute->findOrFail($request->id);
        $attribute->values()->delete();
        $attribute->realstate()->detach();
        (new FileManager)->deleteFile($attribute->icon, 'images/attributes');
        $attribute->delete();
    }
    public function deleteValue($request)
    {
        $attribute = $this->attribute->findOrFail($request->id);
        $attribute->values()->whereid($request->value_id)->first()->delete();
        return $attribute;
    }


}
