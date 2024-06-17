<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function store(UserRequest $request)
    {
        $user = (new AuthService)->store($request);
        return $this->sendResponse($user);
    }
    public function login(UserRequest $request)
    {
        $user = (new AuthService)->login($request);
        return $this->sendResponse($user);
    }
    public function logout()
    {
        $user = (new AuthService)->logout();
        return $this->sendResponse($user);
    }
}
