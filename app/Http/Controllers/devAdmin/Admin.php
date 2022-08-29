<?php

namespace App\Http\Controllers\devAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Object_;

class Admin extends Controller
{
    public function index(Request $request)
    {
        $page_data = [
            'menu' => 'inicio',
            'titulo' => 'Início',
            'breadcumb' => ['Areá Principal']
        ];
        return view('dev-admin.index', [
            'page_data' => (object) $page_data
        ]);
    }
}
