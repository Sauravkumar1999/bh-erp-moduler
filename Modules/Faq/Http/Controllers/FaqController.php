<?php

namespace Modules\Faq\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Faq\DataTables\TableView\FaqDataTable;
use Modules\Faq\DataTables\Editor\FaqDataTableEditor;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(FaqDataTable $dataTable)
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => trans('product::product.add-product'), 'url' => '#']
        ];

        return $dataTable->render('faq::index', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param FaqDataTableEditor $editorTable
     * @return Renderable
     * @throws \Yajra\DataTables\DataTablesEditorException
     */
    public function store(Request $request, FaqDataTableEditor $editorTable)
    {
        return $editorTable->process($request);
    }

}
