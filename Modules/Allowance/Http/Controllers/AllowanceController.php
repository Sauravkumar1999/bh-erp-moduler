<?php

namespace Modules\Allowance\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Routing\Controller;
use Modules\Allowance\Entities\Allowance;
use Modules\User\Entities\User;
use Modules\Allowance\Http\Requests\AllowanceRequest;
use Modules\Allowance\Services\AllowanceService;
use Modules\Allowance\DataTables\TableView\AllowanceDataTable;
use Modules\Allowance\Imports\AllowancesImport;

class AllowanceController extends Controller
{

    public function __construct(private AllowanceService $allowanceService)
    {
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(AllowanceDataTable $dataTable)
    {
        $allowance = Allowance::all();
        $breadcrumbs = [['name' => trans('core::core.home'), 'url' => route('dashboard')], ['name' => trans('allowance::allowance.allowances'), 'url' => '#']];
        return $dataTable->render('allowance::allowances.index', compact('breadcrumbs', 'allowance'));
    }

    public function importData(Request $request)
    {
        try {
            Excel::import(new AllowancesImport, $request->file('importAllowanceData'));
            return redirect()->back()->with('success', "Data imported successfully.");
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                return back()->withError($e->getMessage() . ' at row: '.$failure->row(). ' ' . $failure->errors()[0]);
            }
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $breadcrumbs = [['name' => trans('core::core.home'), 'url' => route('dashboard')], ['name' => trans('allowance::allowance.allowance-management'), 'url' => '#']];
        $members = User::query()->get();
        return view('allowance::allowances.create', compact('breadcrumbs', 'members'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(AllowanceRequest $request)
    {
        try {
            $request->validated();
            $this->allowanceService->save($request->all());
            return redirect()->route('admin.allowances.index')->withSuccess(__('allowance::allowance.successfully-created'));
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param Allowance $allowance
     * @return Renderable
     */
    public function edit(Allowance $allowance)
    {
        $breadcrumbs = [['name' => trans('core::core.home'), 'url' => route('dashboard')], ['name' => trans('allowance::allowance.allowance-management'), 'url' => '#']];
        $members = User::query()->get();
        return view('allowance::allowances.edit', compact('breadcrumbs', 'members', 'allowance'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Allowance $allowance
     * @return Renderable
     */
    public function update(Request $request, Allowance $allowance)
    {
        try {
            $this->allowanceService->save($request->all(), $allowance);
            return redirect()->route('admin.allowances.index')
                ->withSuccess(__('allowance::allowance.successfully-updated'));
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Allowance $allowance
     * @return Renderable
     */
    public function destroy(Allowance $allowance)
    {
        try {
            $allowance->delete();
            return redirect()->route('admin.allowances.index')
                ->withSuccess(__('allowance::allowance.successfully-deleted'));
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage());
        }
    }
}
