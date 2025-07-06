<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearningRedirect extends Controller
{
    function redirect()
    {
        return view('auth.login');
    }
    function redirectToDashboard()
    {
        return view('auth.login');
    }
    function redirectToAboutUs()
    {
        return view('aboutUs');
    }

}
