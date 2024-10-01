<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\DataTables\TableView\PageMetaDataTable;
use Modules\Core\Entities\PageMeta;
use Modules\Core\Services\PageMetaService;
use Modules\Media\Traits\MediaHandler;
use Plank\Mediable\Media;

class PageMetaController extends Controller
{
    use MediaHandler;
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __construct(private PageMetaService $pagemetaservice)
    {
    }
    public function index(PageMetaDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Home', 'url' => route('dashboard')], ['name' => 'Page Meta Tags', 'url' => '#']];
        return $dataTable->render('core::page-meta-tags.index', compact('breadcrumbs'));
        // return user()->isAbleTo('view-page-meta') ?
        // $dataTable->render('core::page-meta-tags.index', compact('breadcrumbs')) :
        // redirect()->route('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $breadcrumbs = [['name' => 'Home', 'url' => route('dashboard')], ['name' => 'Page Meta Tags', 'url' => '#']];
        return view('core::page-meta-tags.add', compact('breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $data = [
                'page_url' => $request->input('page_url'),
                'status' => $request->input('status') === 'active' ? 1 : 0,
                'meta_information' => collect($request->input('property'))->map(function ($property, $index) use ($request) {
                    return [
                        'property' => $property,
                        'content' => $request->input('content')[$index]
                    ];
                })->toArray(),
            ];
            $pagemeta = $this->pagemetaservice->save($data);

            if ($request->has('og_image') && $request->og_image != null) {
                $media = Media::where('filename', $request->og_image)->first();
                $pagemeta->attachMedia($media, 'og_image');
                $pagemeta->meta_information = array_merge($pagemeta->meta_information ?? [], [['property' => 'og:image', 'content' => $pagemeta->og_image()]]);
                $pagemeta->save();
            }
            return redirect()->route('admin.page-meta-tags.index')->withSuccess('Data Stored successfully!');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('core::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(PageMeta $pagemeta)
    {
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => trans('core::page-meta.edit'), 'url' => '#']
        ];

        return $pagemeta ? view('core::page-meta-tags.edit', compact('breadcrumbs', 'pagemeta')) : redirect()->back()->withError('PageMeta Not Found');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, PageMeta $pagemeta)
    {
        try {
            $data = [
                'page_url' => $request->input('page_url'),
                'status' => $request->input('status') === 'active' ? 1 : 0,
                'meta_information' => collect($request->input('property'))->map(function ($property, $index) use ($request) {
                    return [
                        'property' => $property,
                        'content' => $request->input('content')[$index]
                    ];
                })->toArray(),
            ];
            $hasOgImage = collect($pagemeta->meta_information)->contains('property', 'og:image');
            if ($hasOgImage &&  $request->og_image != null) {
                $data['meta_information'] = array_merge($data['meta_information'] ?? [], [['property' => 'og:image', 'content' => $pagemeta->og_image()]]);
            }

            $pagemeta = $this->pagemetaservice->save($data, $pagemeta);
            return redirect()->route('admin.page-meta-tags.index')->withSuccess('Data Stored successfully!');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(PageMeta $pageMeta)
    {
        $pageMeta->delete();
        return response()->json(['message', 'Data deleted']);
    }
    public function handleImage(Request $request, PageMeta $pagemeta = null)
    {
        if ($request->hasFile('file')) {
            $pagemetaimage = $this->uploadPageMetaImage($request->file('file'));
            if ($pagemeta) {
                $pagemeta->syncMedia($pagemetaimage, 'og_image');
                return null;
            } else {
                return $pagemetaimage;
            }
        }
        return null;
    }
}
