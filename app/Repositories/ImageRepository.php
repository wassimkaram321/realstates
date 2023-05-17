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
        return $this->image->whereid($id)->get();
    }
    public function create($request)
    {
        # code...
        return $this->create($request->all());
    }
    public function update($request)
    {
        $image = $this->image->find($request->id);
        $image->update($request->all());
        return $image;
    }
    public function delete($id)
    {
        return $this->image->findOrFail($id)->delete();
    }

}
