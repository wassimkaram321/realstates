<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
            'title' => 'required',
            'title_ar' => 'required',
            'content' => 'required',
            'content_ar' => 'required',
            'adcategory_id' => 'required',
        ];
    }
    public function update()
    {

        return [
            'id' => 'required',
            'initial_balance' => 'required',

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
