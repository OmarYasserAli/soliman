<?php
// app/Imports/YourImportClass.php
namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LeadExport implements FromArray, WithColumnFormatting
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }
    public function columnFormats(): array
    {
        return [
            'D' => '+#', // Assuming 'B' is the column where phone numbers are located
            // Add more columns as needed
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 15,
            'C' => 15,
            'D' => 20,
            'E' => 15,
            'F' => 15,
        ];
    }
}
