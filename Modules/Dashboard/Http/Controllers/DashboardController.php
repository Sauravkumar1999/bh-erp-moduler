<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // this is temporary and will be removed as soon as the dashboard UI is updated
        if (!user()->isAdmin()) {

            return redirect()->route('admin.my-info.edit', user()->id);
        }
        /////
        
        return view('dashboard::index');
    }
}
