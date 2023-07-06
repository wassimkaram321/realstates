<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RealEstateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->getFunctionName()) {
            case 'index':
                return $this->index();
            case 'create':
                return $this->store();
            case 'update':
                return $this->store();
            case 'show':
                return $this->show();
            case 'destroy':
                return $this->show();
            default:
                return [];
        }
    }
    public function show()
    {
        # code...
        return [
            'id' => 'required',
        ];
    }
    public function index()
    {
        # code...
        return [
        ];
    }
    public function store()
    {
        # code...
        return [
            'name' => 'required',
            'name_ar' => 'nullable',
            'description' => 'required',
            'description_ar' => 'nullable',
            'city_id'=> 'nullable',
            'child_id'=> 'nullable',
            'sub_id'=> 'nullable',
            'price' => 'required',
            'space' => 'required',
            'slug' => 'nullable',
            'latitude' => 'nullable',
            'longtitude' => 'nullable',
            'cat_id' => 'nullable',
            'cat_type' => 'nullable',
            'user_id' => 'nullable',
            'image' => 'nullable',
            'status' => 'nullable',
            'tags' => 'nullable',
            'attributes' => 'nullable',
            'images' => 'nullable',
            'address' => 'nullable',
        ];
    }
    public function update()
    {

        return [
        ];
    }
    public function getFunctionName(): string
    {
        $action = $this->route()->getAction();
        $controllerAction = $action['controller'];
        list($controller, $method) = explode('@', $controllerAction);
        return $method;
    }
}
