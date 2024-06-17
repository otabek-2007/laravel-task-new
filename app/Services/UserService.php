<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function edit($request, $id)
    {
        $user = User::find($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        if ($request['password'] != null) {
            $user->password = bcrypt($request['password']);
        }
        $user->save();
        return $user;
    }
    public function profile()
    {
        $user = Auth::user();
        return $user;
    }

}
