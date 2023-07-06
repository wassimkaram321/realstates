<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
            case 'store':
                return $this->store();
            case 'update':
                return $this->store();
            case 'show':
                return $this->show();
            case 'destroy':
                return $this->show();
            case 'change_status':
                return $this->show();
            case 'change_feature':
                return $this->show();
            case 'change_recommended':
                return $this->show();
            case 'create_image':
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
        return [];
    }
    public function store()
    {
        # code...
        return [
            'name'           => 'required',
            'name_ar'        => 'nullable',
            'description'    => 'required',
            'description_ar' => 'nullable',
            'cat_id'         => 'required|exists:vehicle_categories,id',
            'sub_id'         => 'required|exists:vehicle_subcategories,id',
            'child_id'       => 'required|exists:vehicle_childcategories,id',
            'package_id'     => 'nullable|exists:packages,id',
            'rent_id'        => 'required|exists:categories,id',
            'price'          => 'required',
            'image'          => 'nullable',
            'images'         => 'nullable',
            'slug'           => 'nullable',
            'latitude'       => 'nullable',
            'longtitude'     => 'nullable',
            'year'           => 'nullable',
            'km'             => 'nullable',
            'status'         => 'nullable',
            'tags'           => 'nullable',
            'attributes'     => 'nullable',
            'address'        => 'nullable',
        ];
    }
    public function update()
    {
        return [
            'id'             => 'required|exists:vehicles,id',
            'name'           => 'required',
            'name_ar'        => 'nullable',
            'description'    => 'required',
            'description_ar' => 'nullable',
            'cat_id'         => 'required|exists:vehicle_categories,id',
            'sub_id'         => 'required|exists:vehicle_subcategories,id',
            'child_id'       => 'required|exists:vehicle_childcategories,id',
            'package_id'     => 'nullable|exists:packages,id',
            'rent_id'        => 'required|exists:categories,id',
            'price'          => 'required',
            'image'          => 'nullable',
            'images'         => 'nullable',
            'slug'           => 'nullable',
            'latitude'       => 'nullable',
            'longtitude'     => 'nullable',
            'year'           => 'nullable',
            'km'             => 'nullable',
            'status'         => 'nullable',
            'tags'           => 'nullable',
            'attributes'     => 'nullable',
            'address'        => 'nullable',
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
