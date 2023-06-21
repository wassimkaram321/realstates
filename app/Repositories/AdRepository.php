<?php

namespace App\Repositories;

// use App\Models\Repositories;
use App\Manager\FileManager;

use App\Models\Ad;

class AdRepository
{
    protected $Ad;

    public function __construct(Ad $Ad)
    {
        $this->Ad = $Ad;
    }

    // Add your methods here
    public function all()
    {
        return $this->Ad::all();
    }

    public function find($id)
    {
        return $this->Ad::findOrFail($id);
    }

    public function create($request)
    {
        $ad = $this->Ad->create($request->all());
        if($request->file('image'))
        {
            $file_name  = (new FileManager())->addFile($request->file('image'),'images/ADS');
            $ad->image = $file_name;
            $ad->save();
        }
        return $ad;
        // return $this->Ad::create($data);
    }

    public function update($request)
    {
        $model = $this->Ad::findOrFail($request->id);
        $input= $request->all();
          if ($file = $request->file('image')) {

        $file_name = (new FileManager())->addFile($input['image'], 'images/real_estate_images');
         $input['image'] =  $file_name;
          }
        $model->update($input);

        return $model;
    }

    public function delete($id)
    {
        $model = $this->Ad::findOrFail($id);
        $model->delete();
        return $model;
    }

    public function rules()
    {
        return [];
    }

    public function rules_update()
    {
        return [];
    }
}