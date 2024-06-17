<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function update(UserRequest $request, $id)
    {
        $user = (new UserService)->edit($request, $id);
        return $this->sendResponse($user);
    }
    public function profile()
    {
        $user = (new UserService)->profile();
        return $this->sendResponse($user);
    }

}
