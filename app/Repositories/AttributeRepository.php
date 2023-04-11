<?php

namespace App\Repositories;

use App\Models\Attribute;
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

    public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }
    public function all()
    {
        # code...
        return $this->attribute->all();
    }
    public function find($id)
    {
        $attribute = Attribute::whereid($id)->get();
        return $attribute;
    }
    public function create(array $data)
    {
        # code...
        $attributes = Attribute::create($data);
        $attributes->setTranslation('title', 'en', $data['title']);
        $attributes->setTranslation('title', 'ar', $data['title_ar']);
        $attributes->setTranslation('content', 'en', $data['content']);
        $attributes->setTranslation('content', 'ar', $data['content_ar']);
        $attributes->save();
        return $attributes;
    }
    public function update($id,array $data)
    {
        $attributes = Attribute::find($id);
        $attributes->update($data);
        $attributes->setTranslation('title', 'en', $data['title']);
        $attributes->setTranslation('title', 'ar', $data['title_ar']);
        $attributes->setTranslation('content', 'en', $data['content']);
        $attributes->setTranslation('content', 'ar', $data['content_ar']);
        $attributes->save();
        return $attributes;
    }
    public function delete($id)
    {
        
        return $this->attribute->destroy($id);
    }
    
   
    public function rules()
    {
        # code...
        return [
            'title' => 'required',
            'title_ar' => 'required',
            'content' => 'required',
            'content_ar' => 'required',
            'real_state_id' => 'required',
           
        ];
    }
    public function rules_update()
    {
        # code...
        return [
            'title' => 'nullable',
            'title_ar' => 'nullable',
            'content' => 'nullable',
            'content_ar' => 'nullable',
            'real_state_id' => 'nullable',
        ];
    }
}
