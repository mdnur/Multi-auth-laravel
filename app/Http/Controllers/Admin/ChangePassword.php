<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function showChangePassword()
    {
        return view('admin.changepassword');
    }

    public function changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current_password'),Auth::user()->getAuthPassword()))){
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current_password'), $request->get('password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password");
        }


        $this->validate($request,[
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->get('password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");


    }
}
