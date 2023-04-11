<?php

namespace App\Repositories;

use App\Models\Tag;
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
    public function all()
    {
        return $this->tag->get(['id','title']);
    }

    /**
     * Find a tag by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        $tag = Tag::whereid($id)->get();
        return $tag;
    }

    /**
     * Create a new tag.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $tag = Tag::create($data);
        $tag->setTranslation('title', 'en', $data['title']);
        $tag->setTranslation('title', 'ar', $data['title_ar']);
        $tag->save();
        return $tag;
    }

    /**
     * Update an existing tag.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $tag = Tag::find($id);
        $tag->update($data);
        $tag->setTranslation('title', 'en', $data['title']);
        $tag->setTranslation('title', 'ar', $data['title_ar']);
        $tag->save();
        return $tag;
    }

    /**
     * Delete a tag by ID.
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id)
    {
        $tag = Tag::Find($id);
        return $this->tag->destroy($id);
    }

    /**
     * Get all real states associated with a tag.
     *
     * @param int $id
     * @return mixed
     */
    public function tag_real_states($id)
    {
        $tag = Tag::findOrFail($id);
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