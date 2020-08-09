<?php

namespace App\Http\Controllers;

use App\Page;
use App\People;
use App\Portfolio;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $pages = Page::all();
        $services = Service::all();
        $portfolios = Portfolio::all();
        $peoples = People::all();

        $filters = DB::table('portfolios')->distinct()->pluck('filter');

        $menu = [];
        foreach ($pages as $page){
            $menu[]=['title' => $page->name,'alias' => $page->alias];
        }
        $menu[]=['title' => 'Services','alias' => 'service'];
        $menu[]=['title' => 'Portfolio','alias' => 'portfolio'];
        $menu[]=['title' => 'Clients','alias' => 'clients'];
        $menu[]=['title' => 'Team','alias' => 'team'];
        $menu[]=['title' => 'Contact','alias' => 'contact'];

        return view('index',['menu' => $menu,
            'pages' => $pages,
            'services' => $services,
            'portfolios' =>$portfolios,
            'peoples' => $peoples,
            'filters' => $filters,
            ]);
    }
}
