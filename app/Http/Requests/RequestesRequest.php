<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest; 

class RequestesRequest extends FormRequest
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
        return [
            //
        ];
    }
    public function show()
    {
        # code...
        return [
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
            'user_id'     => 'required',
            'bookedup_id' => 'nullable',
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
