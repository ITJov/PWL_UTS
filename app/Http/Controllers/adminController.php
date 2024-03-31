<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminController extends Controller
{
    function admin(){
        echo("test admin");
        echo (Auth::user()->name);
        echo("<a href='/logout'>Logout</a>>");
    }
    function user(){
        echo("test user");
        echo (Auth::user()->name);
        echo("<a href='/logout'>Logout</a>>");
    }
}
