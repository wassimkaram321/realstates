<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            case 'makeRealestateReview':
                return $this->store();
            case 'update':
                return $this->store();
            case 'RealestateReviews':
                return $this->show();
            case 'deleteRealestateReview':
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
            'realestate_id'=>'required|exists:real_states,id',
            'rate' => 'required|integer|max:5|min:0',
            'review'=>'nullable'
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
