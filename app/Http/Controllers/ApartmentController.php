<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('apartment.index');
    }

    public function show($id)
    {
        return view('apartment.show', ['id' => $id]);
    }
}
