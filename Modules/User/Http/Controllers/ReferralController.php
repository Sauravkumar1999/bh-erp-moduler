<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\User\DataTables\TableView\ReferralDataTable;
use Modules\User\Entities\User;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ReferralDataTable $dataTable
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function index(ReferralDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Home', 'url' => route('dashboard')], ['name' => 'Referrals', 'url' => '#']];

        return $dataTable->render('user::referrals.index', compact('breadcrumbs'));
    }

    /**
     * Show the hierarchical view of the users referals.
     *
     * @param \Modules\User\Entities\User $user
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function view(User $user)
    {
        $breadcrumbs = [
                ['name' => 'Home', 'url' => route('dashboard')],
                ['name' => 'Referrals', 'url' => route('admin.referrals.index')],
            ];

        return view('user::referrals.view', compact('user', 'breadcrumbs'));
    }

}
