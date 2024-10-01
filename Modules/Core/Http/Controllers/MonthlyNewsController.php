<?php

namespace Modules\Core\Http\Controllers;

use Plank\Mediable\Media;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Media\Traits\MediaHandler;
use Illuminate\Support\Facades\Storage;
use Modules\Core\DataTables\TableView\MonthlyNewsDataTable;
use Modules\Core\DataTables\Editor\MonthlyNewsDataTableEditor;

class MonthlyNewsController extends Controller
{
    use MediaHandler;

    /**
     * Display a listing of the resource.
     *
     * @param MonthlyNewsDataTable $dataTable
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(MonthlyNewsDataTable $dataTable)
    {
        $breadcrumbs = [['name' => 'Home', 'url' => route('dashboard')], ['name' => 'Monthly News', 'url' => '#']];

        return user()->isAbleTo('view-monthly-news') ?
            $dataTable->render('core::monthly-news.index', compact('breadcrumbs')) :
            redirect()->route('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param MonthlyNewsDataTableEditor $editorTable
     * @return \Illuminate\Http\Response
     * @throws \Yajra\DataTables\DataTablesEditorException
     */
    public function store(Request $request, MonthlyNewsDataTableEditor $editorTable)
    {
        return $editorTable->process($request);
    }

    public function handleMonthlyNewsImage(Request $request)
    {
        if ($request->hasFile('file')) {

            $monthlyNewsMedia = $this->uploadMonthlyNewsImage($request->file('file'));

            setting(['monthly-news-img' => $monthlyNewsMedia->basename])->save();

            $this->syncMonthlyNewsMedia($monthlyNewsMedia);

            return $monthlyNewsMedia;
        }

        return null;
    }

    /**
     * Delete old media
     *
     * @param Media $monthlyNewsMedia
     * @return void
     */
    private function syncMonthlyNewsMedia(\Plank\Mediable\Media $monthlyNewsMedia)
    {
        // Delete DB media
        Media::inDirectory($monthlyNewsMedia->disk, $monthlyNewsMedia->directory)
            ->where('filename', '!=', $monthlyNewsMedia->filename)
            ->delete();

        $files = Storage::disk($monthlyNewsMedia->disk)->allFiles($monthlyNewsMedia->directory);

        // Delete directory media files
        foreach ($files as $file) {
            if (pathinfo($file)['filename'] != $monthlyNewsMedia->filename) {
                Storage::disk($monthlyNewsMedia->disk)->delete($file);
            }
        }
    }

}
