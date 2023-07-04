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

    public function __construct(Attribute $attribute , AttributeManager $attributeManager)
    {
        $this->attribute = $attribute;
        $this->attributeManager = $attributeManager;
    }
    public function all($request)
    {
        App::setlocale($request->lang);
        return $this->attribute->with('values')->get();
    }
    public function find($id)
    {
        return $this->attribute->with('values')->whereid($id)->first();
    }
    public function create($request)
    {
        # code...

        $attribute = $this->attribute->create($request->all());
        if($request->icon != null){
            $file_name  = (new FileManager())->addFile($request->file('icon'), 'images/attributes');
            $attribute->icon = $file_name;
            $attribute->save();
        }
        $this->attributeManager->setTranslation($attribute,$request);

        //create attribute values
        $values = $request->values ?? [];
        foreach($values as $value){
            $attribute->values()->create(
                [
                    'value'=>$value
                ]
            );
        }
        foreach($attribute->values() as $value){

            $this->attributeManager->setValueTranslation($value,$request);
        }
        return $attribute;
    }
    public function update($request)
    {

        $attribute =  $this->attribute->find($request->id);
        $this->checkValues($attribute,$request);
        if($request->icon != null){
            (new FileManager())->deleteFile($request->file('icon'), 'images/attributes');
            $file_name  = (new FileManager())->addFile($request->file('icon'), 'images/attributes');
            $attribute->icon = $file_name;
            $attribute->save();
        }
        $attribute->update($request->all());
        $this->attributeManager->setTranslation($attribute,$request);


        $values = $request->values ?? [];



        $attribute->values()->delete();
        foreach($values as $value){
            $attribute->values()->create(
                [
                    'value'=>$value
                ]
            );
        }
        return $attribute;
    }
    public function delete($request)
    {
        $attribute = $this->attribute->findOrFail($request->id);
        $attribute->values()->delete();
        $attribute->realstate()->detach();
        (new FileManager)->deleteFile($attribute->icon,'images/attributes');
        $attribute->delete();

    }
    public function checkValues($attribute,$request)
    {
        $old_values = $attribute->values()->pluck('value')->toArray();
        $new_values = $request->values[0];
        $diff_values = array_diff($old_values,$new_values);
        $selected_values = $attribute->realstate()->whereIn('selected_value',$diff_values)->get()->count();
        if($selected_values > 0){
            throw new Exception('Can not update , deleted values are linked to realestates : '.implode('',$diff_values));
        }
    }



}
