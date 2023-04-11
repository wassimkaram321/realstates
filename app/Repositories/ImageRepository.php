<?php

namespace App\Repositories;

use App\Models\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Spatie\Permission\Models\Role;

//use Your Model

/**
 * Class userRepository.
 */
class ImageRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }
    public function all()
    {
        # code...
        return $this->image->all();
    }
    public function find($id)
    {
        $image = Image::whereid($id)->get();
        return $image;
    }
    public function create(array $data)
    {
        # code...
        return $this->create($data);
    }
    public function update($id,array $data)
    {
        $image = Image::find($id);
        return $image->update($data);
    }
    public function delete($id)
    {
        $image = Image::Find($id);
        return $this->image->destroy($id);
    }
    
   
    public function rules()
    {
        # code...
        return [
            'title' => 'required',
            'alt' => 'nullable',
            'real_state_id' => 'required',
           
        ];
    }
    public function rules_update()
    {
        # code...
        return [
            'title' => 'nullable',
            'alt' => 'nullable',
            'real_state_id' => 'nullable',
        ];
    }
}
