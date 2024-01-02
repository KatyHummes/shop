<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {

        $stores =  Store::all(); 
        return view('welcome', compact('stores'));
    }
}
