<?php

namespace App\Imports;

use App\Models\Medicine;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class MedicinesImport implements ToModel
{
    public function model(array $row)
    {
        // Skip header row
        if ($row[0] === 'name' || empty($row[0])) {
            return null;
        }

        return new Medicine([
            'name' => $row[0],
            'description' => $row[1] ?? null,
            'batch_no'    => $row['batch_no'] ?? null,
            'mrp' => $row['mrp'] ?? 0,
            'price' => $row[2] ?? 0,
            'expiry_date' => isset($row[3]) ? Date::excelToDateTimeObject($row[3]) : now(),
            'total_stock' => $row[4] ?? 0,
            'is_featured' => $row[5] ?? false,
            'category_id' => $row[6] ?? 1, // adjust as per your data
            'manufacturer_id' => $row[7] ?? 1
        ]);
    }
}

