<?php

namespace Modules\Bulletin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Bulletin\DataTables\Editor\BulletinDataTableEditor;
use Modules\Bulletin\DataTables\TableView\BulletinDataTable as TableViewBulletinDataTable;
use Modules\Bulletin\Entities\Bulletin;
use Modules\Bulletin\Events\UserViewed;
use Modules\Media\Traits\MediaHandler;
use Modules\User\Entities\Role;

class BulletinController extends Controller
{
    use MediaHandler;

    /**
     * Display a listing of the resource.
     * @param TableViewBulletinDataTable $dataTable
     * @return Renderable
     */

    public function index(TableViewBulletinDataTable $dataTable)
    {
        $title = trans('bulletin::bulletin.bulletin-management');
        $breadcrumbs = [['name' => trans('bulletin::msg.home'), 'url' => route('dashboard')], ['name' => trans('bulletin::msg.bulletin'), 'url' => '#']];
        $roles = Role::all();
        return $dataTable->render('bulletin::index', compact('breadcrumbs', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param BulletinDataTableEditor $editorTable
     * @return Renderable
     * @throws \Yajra\DataTables\DataTablesEditorException
     */
    public function store(Request $request, BulletinDataTableEditor $editorTable)
    {
        return $editorTable->process($request);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $authRoleId = auth()->user()->roles->pluck('id')->toArray();
        $authRoleId = array_map('strval', $authRoleId);

        if (auth()->user()->isAdmin()) {
            $post = Bulletin::where('id', $id)
                ->with('author')
                ->orderBy('id', 'desc')
                ->first();
            $nextPost = Bulletin::where('id', '>', $id)
                ->with('author')
                ->orderBy('id', 'desc')
                ->first();
            $previousPost = Bulletin::where('id', '<', $id)
                ->with('author')
                ->orderBy('id', 'desc')
                ->first();
        } else {
            $post = Bulletin::where('id', $id)
                ->whereJsonContains('permission', $authRoleId)
                ->with('author')
                ->orderBy('id', 'desc')
                ->first();
            $nextPost = Bulletin::where('id', '>', $id)
                ->whereJsonContains('permission', $authRoleId)
                ->with('author')
                ->orderBy('id', 'desc')
                ->first();
            $previousPost = Bulletin::where('id', '<', $id)
                ->whereJsonContains('permission', $authRoleId)
                ->with('author')
                ->orderBy('id', 'desc')
                ->first();
            event(new UserViewed($post));
        }

        return view('bulletin::bulletin.show', compact('post', 'nextPost', 'previousPost'));

    }
}
