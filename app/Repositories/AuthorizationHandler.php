<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

class AuthorizationHandler
{
    public function authorize($permission)
    {
        $user = Auth::user();

        if (!$user || !$user->can($permission)) {
            throw new \Exception('Unauthorized');
        }
    }
    public function canAdd()
    {
        $user = Auth::user();

        if (false) {
            throw new \Exception('Can not add realestate');
        }
    }
}
