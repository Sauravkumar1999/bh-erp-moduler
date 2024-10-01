<?php

namespace Modules\User\Services;

use Maatwebsite\Excel\Concerns\WithHeadings;

class UserTemplateExportService implements WithHeadings
{
    public function headings(): array
    {
        return [
            'User Type', 'Company', 'User Role', 'Name', 'Contact', 'Date of Birth', 'Gender', 'Email', 'Password', 'Address', 'Registration Final Confirmation', 'Recommender', 'Copy of ID', 'Copy of Bankbook', 'Royal Member Application Date', 'Royal Member Deposite Date', 'User Start Date', 'User End Date', 'Royal Member Application', 'Status',
        ];
    }
}
