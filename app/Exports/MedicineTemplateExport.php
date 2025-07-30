<?php 
namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class MedicineTemplateExport implements WithHeadings
{
    public function headings(): array
    {
        return [
            'name',
            'description',
            'price',
            'quantity',
            'category',
            'expiry_date',
            // Add other fields as needed
        ];
    }
}
