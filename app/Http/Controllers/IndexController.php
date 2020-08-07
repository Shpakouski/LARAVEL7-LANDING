<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //
        //dd(Page::all());
        return view('index');
    }
}
