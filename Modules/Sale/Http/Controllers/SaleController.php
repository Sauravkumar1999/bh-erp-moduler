<?php

namespace Modules\Sale\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Sale\Entities\Sale;
use Modules\User\Entities\User;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Sale\Services\SaleService;
use Illuminate\Contracts\Support\Renderable;
use Modules\Sale\Http\Requests\StoreSaleRequest;
use Modules\Sale\Http\Requests\UpdateSaleRequest;
use Modules\Sale\DataTables\TableView\SaleDataTable;



class SaleController extends Controller
{
    /**
     * UserController constructor.
     * @param SaleService $saleService
     */
    public function __construct(private SaleService $saleService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param SaleDataTable $dataTable
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response;
     * @return Renderable
     */


    public function index(SaleDataTable $dataTable)
    {
        $sales = Sale::all();
        $breadcrumbs = [['name' => 'Home', 'url' => route('dashboard')], ['name' => 'Sales', 'url' => '#']];

        return $dataTable->render('sale::sales.index', compact('breadcrumbs', 'sales'));
    }

    public function UserSalePage($code)
    {
        $user = User::where('code', $code)->first();
// dd($user);
        if ($user && $user->status === 1) {
            // User with the given code has a status of 1
            return view('sales.view');
        } else {
            // User not found or status is not 1
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $dropdownData = $this->saleService->getDropdownDataQuery();

        $breadcrumbs = [['name' => 'Home', 'url' => route('dashboard')], ['name' => '매출추가', 'url' => '#']];

        return view('sale::sales.create', compact('breadcrumbs') + $dropdownData);
    }


    /**
     * Store a newly created resource in storage.
     * @param StoreSaleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSaleRequest $request)
    {
        try {
            $request->validated();
            $this->saleService->create($request->validated());
            return redirect()->route('admin.sales.index')->withSuccess(trans('sale::sale.store-success-message'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.sales.create')->withError($th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param Sale $sale
     * @return Renderable
     */
    public function edit(Sale $sale)
    {
        $sale->salesApproval = $this->saleService->hasApprovalRights($sale->product->id);
        $products = get_auth_products();
        //$users = User::all();
        $users = get_auth_users();
        $sale->load(['product', 'seller', 'product.company']);
        $breadcrumbs = [['name' => 'Home', 'url' => route('dashboard')], ['name' => 'Edit Sales', 'url' => '#']];
        return view('sale::sales.edit', [
            'sale'        => $sale,
            'products'    => $products,
            'breadcrumbs' => $breadcrumbs,
            'users'       => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Sale $sale
     * @return Renderable|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSaleRequest $request, Sale $sale)
    {
        try {
            $request->validated();
            $this->saleService->update($sale, $request->validated());
            return redirect()->route('admin.sales.index')->withSuccess(trans('sale::sale.update-success-message'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.sales.edit', ['sale' => $sale->id])->withError($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param Sale $sale
     * @return Renderable
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('admin.sales.index')->withSuceess(trans('sale::sale.destroy-success-message'));
    }

    public function getProduct(Product $product)
    {
        $product = Product::with(['user' => function ($query) {
            $query->withoutGlobalScopes()->with('contacts');
        }, 'company'])->where('id', $product->id)->first();
        $product->salesApproval = $this->saleService->hasApprovalRights($product->id);
        return response()->json($product);
    }
}
