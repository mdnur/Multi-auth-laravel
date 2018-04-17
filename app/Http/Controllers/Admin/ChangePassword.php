<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangePassword extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:admin');
    }

    public function showChangePassword()
    {

    }

    public function changePassword(Request $request)
    {

    }
}
