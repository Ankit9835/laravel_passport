<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
        public function login(Request $request){

    	$request->validate([

    		'email' => 'required|email',
    		'password' => 'required'

    	]);

    	$user = User::where('email', $request->email)->first();

    	if(!$user || !Hash::Check($request->password, $user->password)){
    		throw ValidationException::withMessages([
    			'email' => ['The Provided Credentials Are Incorrect']
    		]);
    	}

    	return $user->createToken('Auth Token')->accessToken;

    }
}
