<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // View location
    private $location = "panel.";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Dashboard Index
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $active_product = DB::table('products')->where('status', 1)->count();
        $inactive_product = DB::table('products')->where('status', 0)->count();

        return view($this->location . 'dashboard', compact('active_product', 'inactive_product'));
    }
}
