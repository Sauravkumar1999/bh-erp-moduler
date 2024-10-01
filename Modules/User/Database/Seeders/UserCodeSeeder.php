<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Modules\User\Entities\Contact;
use Modules\User\Entities\User;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UserCodeSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();

        $users = User::withTrashed()->get();
        try {
            $filePath = storage_path('app/BHrental.xlsx');
            if (file_exists($filePath)) {
                // Load the Excel file
                $spreadsheet = IOFactory::load($filePath);
                $worksheet = $spreadsheet->getActiveSheet();

                // Find and update the cell
                $highestRow = $worksheet->getHighestRow();
                for ($row = 1; $row <= $highestRow; $row++) {
                    $cellValue = $worksheet->getCell('B' . $row)->getValue(); // Assuming old codes are in column A
                    foreach ($users as $user) {
                        if ($cellValue == $user->code) {
                            $newCode = $phone_number = Contact::withTrashed()->where('user_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->value('telephone_1');
                            $worksheet->getCell('C' . $row)->setValue($newCode); // Assuming new codes are in column B
                            break;
                        }
                    }
                }

                // Save the updated Excel file
                $writer = new Xlsx($spreadsheet);
                $writer->save($filePath);
            }
        } catch (\Exception $e) {
            dd($e);
        }

        foreach ($users as $user) {
            $phone_number = Contact::withTrashed()->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->value('telephone_1');

            // Update code column in users table
            if ($phone_number !== null) {
                try {
                    $user->code = $phone_number;
                    $user->save();
                } catch (\PDOException $e) {
                    // Check if the error is due to duplicate entry
                    if ($e->errorInfo[1] == 1062) { // MySQL error code for duplicate entry
                        // Continue to the next user
                        continue;
                    }
                }
            }
        }
    }
}
