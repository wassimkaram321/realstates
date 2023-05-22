<?php

namespace App\Repositories;

use App\Manager\StateManager;
use App\Models\State;
use Illuminate\Support\Facades\App;

class StateRepository
{
    protected $state;
    protected $stateManager;

    public function __construct(State $state, StateManager $stateManager)
    {
        $this->state = $state;
        $this->stateManager = $stateManager;
    }

    // Add your methods here
    public function all($request)
    {

    }

    public function find($request)
    {
        App::setLocale($request->lang);
        return $this->state->all();
    }

    public function create($request)
    {
        $state = $this->state::create([
            'name' => $request->name_en,
            $request->all()
        ]);
        $this->stateManager->setTranslation($state, $request);

        return $state;

    }

    public function update($request)
    {
        $state = $this->state::findOrFail($request->id);
        $state->update([
            'name' => $request->name_en,
            $request->all()
        ]);
        $this->stateManager->setTranslation($state, $request);
        return $state;
    }

    public function delete($request)
    {
        return $this->state::findOrFail($request->id)->delete();
    }

}