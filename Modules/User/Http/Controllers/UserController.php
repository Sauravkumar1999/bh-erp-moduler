<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Modules\User\Entities\User;
use Modules\User\Entities\Role;
use Illuminate\Routing\Controller;
use Modules\User\Services\UserService;
use Modules\User\DataTables\TableView\UserDataTable;
use Modules\User\DataTables\Editor\UserDataTableEditor;

class UserController extends Controller
{

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(private UserService $userService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param UserDataTable $dataTable
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
        $roles = Role::get();
        $breadcrumbs = [['name' => 'Home', 'url' => route('dashboard')], ['name' => 'Users', 'url' => '#']];
        return $dataTable->render('user::users.index', compact('breadcrumbs', 'roles'));
    }

    public function show(User $user)
    {
        $user = $user->load('company', 'roles', 'contacts');
        return response()->json(['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param UserDataTableEditor $editorTable
     * @return \Illuminate\Http\Response
     * @throws \Yajra\DataTables\DataTablesEditorException
     */
    public function store(Request $request, UserDataTableEditor $editorTable)
    {
        return $editorTable->process($request);
    }
    public function getProduct(Request $request)
    {
        $user = User::with('contacts')->where('id', $request->id)->first();
        $userAdminProdSettings = merge_all_product_data($user->adminProductSettings);
        if (count($userAdminProdSettings)) {
            return response()->json(['message' => 'User related all products', 'status' => 'success', 'data' => $userAdminProdSettings, 'user' => $user]);
        }
        return response()->json(['message' => 'Not Found', 'status' => 'failed']);
    }

    public function updateProdSettings(Request $request)
    {
        $user = User::find($request->get('user_id'));

        return $this->userService->updateProdSettings($request->all(), $user) ? response()->json(['success' => 'success !']) :
             response()->json(['error' => 'Error'], 500);

    }
}
