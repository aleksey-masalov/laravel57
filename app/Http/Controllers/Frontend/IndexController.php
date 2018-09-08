<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class IndexController extends Controller
{
    /**
     * @return View
     */
    public function index()
    {
        return view('frontend.index');
    }
}