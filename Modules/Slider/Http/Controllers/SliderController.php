<?php

namespace Modules\Slider\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Media\Traits\MediaHandler;
use Modules\Slider\DataTables\TableView\SliderDataTable;
use Modules\Slider\Entities\Slider;
use Modules\Slider\Entities\SliderItem;
use Modules\Slider\Services\SliderService;
use Plank\Mediable\Media;

class SliderController extends Controller
{
    use MediaHandler;
    public function __construct(private SliderService $sliderService)
    {
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(SliderDataTable $dataTable)
    {
        $breadcrumbs = [
            [
                'name' => trans('core::core.home'),
                'url' => route('dashboard')
            ],
            [
                'name' => trans('Slider::slider.home'),
                'url' => route('admin.slider.view')
            ],
        ];
        $title = trans('slider::slider.slider-management');
        return $dataTable->render('slider::index', compact('breadcrumbs', 'title'));
        // return view('slider::index', compact('breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $breadcrumbs = [
            [
                'name' => trans('core::core.home'),
                'url' => route('dashboard')
            ],
            [
                'name' => trans('Slider::slider.home'),
                'url' => route('admin.slider.create')
            ],
        ];
        $title = trans('slider::slider.create');
        return view('slider::create', compact('breadcrumbs', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $slider = $this->sliderService->save($request->all());
            $itemNames = $request->input('item-name', []);
            $itemTitles = $request->input('item-title', []);
            $itemCaptions = $request->input('item-caption', []);
            $itemUrls = $request->input('item-url', []);
            $itemCustomHtmls = $request->input('item-custom_html', []);
            $itemImages = $request->input('item-image', []);
            $itemStatus = $request->input('item-status', array_fill(0, count($itemNames), 0));
            for ($i = 0; $i < count($itemNames); $i++) {
                $itemData = [
                    'name' => $itemNames[$i] ?? 'n/a',
                    'title' => $itemTitles[$i] ?? 'n/a',
                    'caption' => $itemCaptions[$i] ?? 'n/a',
                    'url' => $itemUrls[$i] ?? 'n/a',
                    'custom_html' => $itemCustomHtmls[$i] ?? 'n/a',
                    'status' => isset($itemStatus[$i]) ? 1 : 0,
                    'slider_id' => $slider->id,
                ];
                $item = $this->sliderService->saveItem($itemData);
                if (isset($itemImages[$i]) && !is_null($itemImages[$i])) {
                    $media = Media::where('filename', $itemImages[$i])->first();
                    if ($media) {
                        $item->attachMedia($media, 'image');
                    }
                }
            }
            return redirect()->route('admin.slider.view')->withSuccess('Slider Stored successfully!');
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
        return view('slider::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, Slider $slider)
    {
        $breadcrumbs = [
            [
                'name' => trans('core::core.home'),
                'url' => route('dashboard')
            ],
            [
                'name' => trans('Slider::slider.home'),
                'url' => route('admin.slider.view')
            ],
        ];
        $title = trans('slider::slider.edit');
        return view('slider::edit', compact('breadcrumbs', 'title', 'slider'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Slider $slider)
    {
        try {
            $slider = $this->sliderService->save($request->all(), $slider);
            $itemNames = $request->input('item-name', []);
            $itemTitles = $request->input('item-title', []);
            $itemCaptions = $request->input('item-caption', []);
            $itemUrls = $request->input('item-url', []);
            $itemCustomHtmls = $request->input('item-custom_html', []);
            $itemImages = $request->input('item-image', []);
            $itemId = $request->input('item-id', []);
            $itemStatus = $request->input('item-status', array_fill(0, count($itemNames), 0));
            for ($i = 0; $i < count($itemNames); $i++) {
                $itemData = [
                    'name' => $itemNames[$i] ?? 'n/a',
                    'title' => $itemTitles[$i] ?? 'n/a',
                    'caption' => $itemCaptions[$i] ?? 'n/a',
                    'url' => $itemUrls[$i] ?? 'n/a',
                    'custom_html' => $itemCustomHtmls[$i] ?? 'n/a',
                    'status' => isset($itemStatus[$i]) ? 1 : 0,
                ];
                if (isset($itemId[$i])) {
                    $sliderItem = SliderItem::where('id', $itemId[$i])->first();
                    $item = $this->sliderService->saveItem($itemData, $sliderItem);
                } else {
                    $itemData['slider_id'] = $slider->id;
                    $item = $this->sliderService->saveItem($itemData);
                    if (isset($itemImages[$i]) && !is_null($itemImages[$i])) {
                        $media = Media::where('filename', $itemImages[$i])->first();
                        if ($media) {
                            $item->attachMedia($media, 'image');
                        }
                    }
                }
            }
            return redirect()->route('admin.slider.view')->withSuccess('Slider Updated successfully!');
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return response()->json(['message', 'Slider deleted']);
    }
    public function destroyItem(SliderItem $item)
    {
        $item->delete();
        return response()->json(['message', 'Item deleted']);
    }
    public function handleSliderItemImage(Request $request, SliderItem $slideritem = null)
    {
        if ($request->hasFile('file')) {
            $sliderItemImage = $this->uploadSliderItemImage($request->file('file'));

            if ($slideritem) {
                $slideritem->syncMedia($sliderItemImage, 'image');
                return null;
            } else {
                return $sliderItemImage;
            }
        }
        return null;
    }
}
