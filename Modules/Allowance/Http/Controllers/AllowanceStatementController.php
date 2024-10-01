<?php

namespace Modules\Allowance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AllowanceStatementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = Auth::user();
        // dd($data->allowance);
        $breadcrumbs = [['name' => 'Home', 'url' => route('dashboard')], ['name' => 'Statement', 'url' => '#']];
        return view('allowance::allowance-statement.index', compact('breadcrumbs', 'data'));
    }
    public function get_allowance($month)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        $allowance = $user->allowance->first(function ($allowance) use ($month) {
            return strtoupper($allowance->payment_month) === strtoupper($month);
        });
        if (!$allowance) {
            return response()->json(['error' => 'Allowance not found for the specified month'], 404);
        }
        return response()->json($allowance);
    }
}
