<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\DataTables\TableView\RoleDataTable;
use Modules\User\DataTables\Editor\RoleDataTableEditor;
use Modules\User\Entities\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RoleDataTable $dataTable
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function index(RoleDataTable $dataTable)
    {
        $roles = Role::all();
        $breadcrumbs = [['name' => 'Home', 'url' => route('dashboard')], ['name' => 'Roles', 'url' => '#']];

        return $dataTable->render('user::roles.index', compact('breadcrumbs','roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param RoleDataTableEditor $editorTable
     * @return \Illuminate\Http\Response
     * @throws \Yajra\DataTables\DataTablesEditorException
     */
    public function store(Request $request, RoleDataTableEditor $editorTable)
    {
        return $editorTable->process($request);
    }
}
