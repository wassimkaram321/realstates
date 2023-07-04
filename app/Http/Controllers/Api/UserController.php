<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $repository;


    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function UserProfile(Request $request)
    {
        $users = $this->repository->find($request->id);
        return $this->success('success', UserResource::make($users));
    }

    public function update(Request $request)
    {
        $data = $this->validate($request, $this->repository->rules_update());
        $this->repository->update($request->id, $data);
        return $this->success('success', []);
    }
    
}


