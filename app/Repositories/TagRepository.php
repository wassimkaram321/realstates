<?php

namespace App\Repositories;

use App\Manager\TagManager;
use App\Models\Tag;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Spatie\Permission\Models\Role;

//use Your Model

/**
 * Class TagRepository.
 */
class TagRepository
{
    /**
     * @var Tag
     */
    protected $tag;

    /**
     * TagRepository constructor.
     *
     * @param Tag $tag
     */
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * Get all tags.
     *
     * @return mixed
     */
    public function all($request)
    {
        App::setlocale($request->lang);
        return $this->tag->get(['id','title']);
    }


    /**
     * Find a tag by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function find($request)
    {
        return $this->tag->findOrFail($request->id);
    }

    /**
     * Create a new tag.
     *
     * @param array $data
     * @return mixed
     */
    public function create($request)
    {
        $tag = $this->tag->create($request->all());
        TagManager::setTranslation($tag,$request);
        return $tag;
    }

    /**
     * Update an existing tag.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update($request)
    {
        $tag = $this->tag->findOrFail($request->id);
        $tag->update($request->all());
        TagManager::setTranslation($tag,$request);
        return $tag;
    }

    /**
     * Delete a tag by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function delete($request)
    {
        $this->tag->findorFail($request->id)->delete();
    }

    /**
     * Get all real states associated with a tag.
     *
     * @param int $id
     * @return mixed
     */
    public function tag_real_states($request)
    {
        $tag = $this->tag->findOrFail($request->id);
        $real_states = $tag->realstates()->with(['attributes','images','tags'])->get();
        return $real_states;
    }

    /**
     * Get the validation rules for creating a tag.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'title_ar' => 'nullable',
        ];
    }

    /**
     * Get the validation rules for updating a tag.
     *
     * @return array
     */
    public function rules_update()
    {
        return [
            'title' => 'nullable',
            'title_ar' => 'nullable',
        ];
    }
}
