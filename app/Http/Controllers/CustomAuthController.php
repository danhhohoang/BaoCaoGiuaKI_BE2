<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function signOut(){
        Auth::logout();
        return redirect('dashboard');
    }
}
