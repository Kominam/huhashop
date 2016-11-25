<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use Auth;

use App\Http\Controllers\Controller;

class LogOutController extends Controller
{
    public function logout() {
    	Auth::logout();
    	return redirect('login');
    }
}
