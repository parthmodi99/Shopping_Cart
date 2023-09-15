<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserLoginController extends Controller
{
    public function login()
    {
        return view('user.pages.auth.login');
    }

    public function signuppage()
    {
        return view('user.pages.auth.signup');
    }

    public function dosignup(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required',
            'password' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false,'code'=>202,'message' => implode("<br>",$validator->errors()->all())], 202);
        }

        $signup = $request->all();

        $signup['password'] = Hash::make($request->password);

        $success = User::create($signup);

        if ($success) {
            return response()->json(['success' => true, 'message' => 'User Created sucessfully.'], 200);
        }
    }

    public function dologin(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'login_email' => 'required|email',
            'login_password' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false,'code'=>202,'message' => implode("<br>",$validator->errors()->all())], 202);
        }

        if (Auth::guard('web')->attempt(['email' => $request->login_email, 'password' => $request->login_password])) {
            return response()->json(['success' => true, 'code'=>200, 'message' => 'Logged in sucessfully.', 'data' => []], 200);
        } else {
            return response()->json(['success' => false,'code'=>202, 'message' => 'Invalid credentials', 'data' => []], 202);
        }
    }

    public function logout(Request $request)
    {
        if(Auth::guard('web')->check())
            Auth::guard('web')->logout();
        return redirect(route("login"));
    }
}
