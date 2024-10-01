<?php
namespace App\DataTables;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Modules\User\Entities\User;

class ChunkedDatatableExportHandler implements FromQuery, WithHeadings, WithMapping, WithChunkReading
{
    use Exportable;

    /**
     * @var Builder
     */
    protected $query;
    protected $headings;

    /**
     * ChunkDatatablesExportHandler constructor.
     * @param Builder $query
     */
    public function __construct($query, $columns)
    {
        $this->query = $query;
        $this->headings = $columns;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        if ($this->headings) {
            return $this->headings->toArray();
        }

        return [];
    }

    /**
    * @param User $user
    */
    public function map($user): array
    {
        $recommCol = null;

        if ($user->parent) {
            $recommender = $user->parent;
            $recommCol = ($recommender && $recommender->code) ? $recommender->first_name .  '(' . $recommender->code . ')' : 'N/A';
        }

        $recContact = null;
        if ($user->parent) {
            $contact = $user->parent?->contacts?->first();
            if ($contact) {
                $recContact = ($contact && $contact->telephone_1) ? $contact->telephone_1 : 'N/A' ;
            }
        }

        $mappedData =  [
            $user->status,
            $user->user_type,
            $user->code,
            $user->company?->name,
            $user->roles?->first()?->name,
            $user->first_name,
            $user->contacts->first()?->telephone_1 ?? $user->telephone_1,
            $user->dob,
            $user->gender,
            $user->email,
            $user->contacts?->first()?->address ?? $user->address,
            ($user->created_at ? date_format($user->created_at, setting('date_format_php', 'Y-m-d')) : '-') .' / '. ($user->final_confirmation ? date_format($user->final_confirmation, setting('date_format_php', 'Y-m-d')) : '-'),
            $recommCol,
            $recContact,
            'Copy of ID card',
            '',
        ];

        if (setting('royal_membership_active', 1)) {
            $membership = null;
            $currentDate = now();

            if ($currentDate >= $user->start_date && $currentDate <= $user->end_date) $membership = 'Royal';
            else $membership = 'N';

            return array_merge($mappedData, [
                $user->submitted_date ? Carbon::parse($user->submitted_date)->format(setting('date_format_php', 'Y-m-d')) : '',
                $user->deposit_date ? Carbon::parse($user->deposit_date)->format(setting('date_format_php', 'Y-m-d')) : '',
                $user->start_date ? Carbon::parse($user->start_date)->format(setting('date_format_php', 'Y-m-d')) : '',
                $user->end_date ? Carbon::parse($user->end_date)->format(setting('date_format_php', 'Y-m-d')) : '',
                $membership
            ]);
        }

        return $mappedData;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->query;
    }

    public function chunkSize(): int
    {
        return 1000; //we can adjust depending on the data size
    }
}
