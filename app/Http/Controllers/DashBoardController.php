<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('layouts.admin.DashBoard.index');
    }
}
