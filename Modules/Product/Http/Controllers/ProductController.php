<?php

namespace Modules\Product\Http\Controllers;

use Plank\Mediable\Media;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Media\Traits\MediaHandler;
use Illuminate\Contracts\Support\Renderable;
use Modules\Product\Services\ProductService;
use Modules\Product\Http\Requests\StoreProductRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;
use Modules\Product\DataTables\TableView\ProductDataTable;

class ProductController extends Controller
{
    use MediaHandler;

    public function __construct(private ProductService $productService)
    {
    }

    /**
     * Display a listing of the resource.
     * @param ProductDataTable $dataTable
     * @return Renderable
     */
    public function index(ProductDataTable $dataTable)
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => trans('product::product.add-product'), 'url' => '#']
        ];

        return $dataTable->render('product::index', compact('breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => trans('product::product.add-product'), 'url' => '#']
        ];
        return view('product::create', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProductRequest $request)
    {
        $request->validated();
        try {
            $product = $this->productService->save($request->all());
            if (isset($request['banner'])) {
                $media = Media::where('filename', $request->banner)->first();
                $product->attachMedia($media, 'banner');
            }
            return redirect()->route('admin.products.index')->withSuccess('Product Stored successfully!');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     * @param Product $product
     * @return Renderable|\Illuminate\Http\RedirectResponse
     */
    public function edit(Product $product)
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => trans('product::product.edit-product'), 'url' => '#']
        ];

        return $product ? view('product::edit', compact('breadcrumbs', 'product')) : redirect()->back()->withError('Product Not Found');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $request->validated();
        try {
            $product = $this->productService->save($request->all(), $product);
            if ($request->hasFile('banner')) {
                $productBanner = $this->uploadBannerImage($request->file('banner'));
                $product->syncMedia($productBanner, 'banner');
            }
            return redirect()->route('admin.products.index')->withSuccess('Product updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->withError($th->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message', 'product deleted']);
    }


    public function handleBannerImage(Request $request, Product $product = null)
    {
        if ($request->hasFile('file')) {

            $productBanner = $this->uploadBannerImage($request->file('file'));

            if ($product) {
                $product->syncMedia($productBanner, 'banner');
                return null;
            } else {
                return $productBanner;
            }
        }
        return null;
    }

    public function getCommissionChargeDetails(Product $product)
    {
        return response()->json(['product' => $product]);
    }
    public function getManagerDetails(Product $product)
    {
        $product = Product::with(['user' => fn ($query) => $query->withoutGlobalScopes(),'user.company', 'user.contacts'])->where('id', $product->id)->first();
        return response()->json(['product' => $product]);
    }
}
// Belongs means company details and postions means role
