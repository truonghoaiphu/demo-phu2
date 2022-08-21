<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login(LoginRequest $request) {

        $data = $request->validated();

        if (Auth::attempt($data)) {
            return redirect('/');
        } else {
            $existUser = DB::table('users')->where('username',$data['username'])->first();
            if ($existUser === null) {
                $user = new User();
                $user->username = $data['username'];
                $user->setPasswordAttribute($data['password']);
                $user->save();
                Auth::attempt($data);
                return redirect('/');
            } else {
                return back()->withErrors('Username already exists or Password is wrong.');
            }

        }
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
