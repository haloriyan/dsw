<?php

namespace App\Exports;

use App\Team;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TeamExport implements FromCollection {
    public function collection() {
        // 
    }
    public function headings(): array {
        return [
            'ID',''
        ];
    }
}