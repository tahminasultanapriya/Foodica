<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Foodica;
use Illuminate\Support\Facades\Storage;

class FoodicaController extends Controller
{
    public function index()
    {
     
        return view('foodica.index');
    }
    

}
