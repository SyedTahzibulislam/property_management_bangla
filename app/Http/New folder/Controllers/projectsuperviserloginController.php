<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class projectsuperviserloginController extends Controller
{
         public function index()
    {

      return view('projectsuperviserlogin.dashboard');
    }
}
