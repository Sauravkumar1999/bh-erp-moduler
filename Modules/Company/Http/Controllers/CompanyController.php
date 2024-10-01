<?php

namespace Modules\Company\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Company\DataTables\TableView\CompanyDataTable;
use Modules\Company\DataTables\Editor\CompanyDataTableEditor;
use Modules\Company\Entities\Company;

class CompanyController extends Controller
{

    /**
     * Display a listing of the resource.
     * @param CompanyDataTable $dataTable
     * @return Renderable
     */
    public function index(CompanyDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Home', 'url' => route('dashboard')], ['name' => trans('company::company.company'), 'url' => '#']];
        $title = trans('company::company.company-management');
        return $dataTable->render('company::index', compact('breadcrumbs', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param CompanyDataTableEditor $editorTable
     * @return \Illuminate\Http\Response
     * @throws \Yajra\DataTables\DataTablesEditorException
     */

    public function store(Request $request, CompanyDataTableEditor $editorTable)
    {
        return $editorTable->process($request);
    }

    public function getCompanyNamesByIds($companyIds)
    {
        // Split the companyIds string into an array of IDs
        $ids = explode(',', $companyIds);

        // Fetch companies using the array of IDs
        $companies = Company::whereIn('id', $ids)->get();

        // Prepare the response array
        $response = $companies->pluck('name', 'id')->toArray();

        return response()->json($response);
    }

}
