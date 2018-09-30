<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('backend.view');
    }

    /**
     * @return View
     */
    public function dashboard()
    {
        return view('backend.dashboard');
    }
}