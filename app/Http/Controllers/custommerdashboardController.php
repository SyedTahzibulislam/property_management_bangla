<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class custommerdashboardController extends Controller
{
        public function index()
    {

      return view('customerbalacesheet.selfsheet');
    }
}
