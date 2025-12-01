<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RoutingController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        // $this->
        // middleware('auth')->
        // except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        if (Auth::user()) {
            return redirect('/index');
        } else {
            return redirect('login');
        }
    }

    /**
     * Display a view based on first route param
     *
     * @return \Illuminate\Contracts\View\View
     */
    // public function root(Request $request, $first)
    public function root(Request $request, $first = 'index')
    {
        // return view($first);
        if (View::exists($first)) {
            return view($first);
        }
        return view('inc.error-404');
    }

    /**
     * second level route
     */
    public function secondLevel(Request $request, $first, $second)
    {
        // return view($first . '.' . $second);
        $viewName = $first . '.' . $second;
        if (View::exists($viewName)) {
            return view($viewName);
        }
        return view('inc.error-404');
    }

    /**
     * third level route
     */
    public function thirdLevel(Request $request, $first, $second, $third)
    {
        // return view($first . '.' . $second . '.' . $third);
        $viewName = $first . '.' . $second . '.' . $third;
        if (View::exists($viewName)) {
            return view($viewName);
        }
        return view('inc.error-404');
    }
}
