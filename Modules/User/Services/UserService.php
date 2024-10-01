<?php

namespace Modules\User\Services;

use Modules\User\Entities\User;
use Maatwebsite\Excel\Facades\Excel;
use Modules\User\Services\UserImportService;
use Modules\User\Services\UserTemplateExportService;



class UserService
{

    public function save()
    {

    }

    public function update()
    {

    }

    public function updateProdSettings(array $data, User $user)
    {
        $syncData = [];

        try {
            if (!empty($data) && !empty($data['products'])) {

                foreach ($data['products'] as $pid) {
                    $url = 'url_' . $pid;

                    $syncData[$pid] = [
                        'url'    => $data['url_' . $pid] ? $data['url_' . $pid] : '',
                        'status' => $data['prod_expose_' . $pid] == 'on'
                    ];
                }
            }

            $user->adminProductSettings()->sync($syncData, false);

            return true;

        } catch (\Exception $e) {
            return false;
        }

    }

    public function importUsersFromExcel($filePath)
    {
        $Log = ['success' => [], 'errors' => []];

        try {
            Excel::import(new UserImportService($Log), $filePath);

            // $Log['failed_insertions'] = url('storage/' . $this->exportFailedRecords($Log['errors']));

            return $Log;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function generateUserTemplate()
    {
        return new UserTemplateExportService();
    }

    public function exportFailedRecords($failedRecords)
    {
        $export = Excel::store(new UserTemplateExportService($failedRecords), 'failed_records.xlsx');
        return $export;
    }

}


