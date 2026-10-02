<?php

namespace App\Http\Controllers;

use App\Models\Cliente;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home', [
            'total'     => Cliente::count(),
            'recientes' => Cliente::latest()->take(5)->get(),
        ]);
    }
}
