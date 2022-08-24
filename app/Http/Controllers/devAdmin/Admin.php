<?php

namespace App\Http\Controllers\devAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function index(Request $request)
    {
        return view('dev-admin.index');
    }
}
