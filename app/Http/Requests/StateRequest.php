<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateRequest extends FormRequest
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
                return $this->destroy();
            default:
                return [];
        }
    }
    public function show()
    {
        # code...
        return [
            'lang'=>'required'
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
            'name_en' => 'required',
           
        ];
    }
    public function update()
    {

        return [
            'id' => 'required',

        ];
    }
    public function destroy()
    {
        return [
            'id' => 'required|exists:states,id,message:Invalid state ID',
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
