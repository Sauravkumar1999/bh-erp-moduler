<?php

namespace Modules\Allowance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Allowance\DataTables\Editor\AllowancePaymentTableEditor as EditorAllowancePaymentTableEditor;
use Modules\Allowance\DataTables\TableView\AllowancePaymentDataTable;
use Modules\Allowance\DataTables\Editor\AllowancePaymentTableEditor;
use Modules\Allowance\Entities\AllowancePayment;

class AllowancePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(AllowancePaymentDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Home', 'url' => route('dashboard')], ['name' => 'Allowances', 'url' => '#']];
        return $dataTable->render('allowance::allowance-payments.index', compact('breadcrumbs'));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param AllowancePaymentTableEditor $editorTable
     * @return Renderable
     * @throws \Yajra\DataTables\DataTablesEditorException
     */
    public function store(Request $request, EditorAllowancePaymentTableEditor $editorTable)
    {
        return $editorTable->process($request);
    }
    public function show($id)
    {
        $post = AllowancePayment::where('id', $id)->with('writer')->orderBy('id', 'desc')->first();
        $nextPost = AllowancePayment::where('id', '>', $id)->with('writer')->orderBy('id', 'desc')->first();
        $previousPost = AllowancePayment::where('id', '<', $id)->with('writer')->orderBy('id', 'desc')->first();
        return view('allowance::allowance-payments.show', compact('post', 'nextPost', 'previousPost'));
    }
}
