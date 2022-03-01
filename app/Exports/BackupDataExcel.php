<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BackupDataExcel implements FromView
{
    public function view(): View
    {
        $data = [
            'invoices' => [[
                'name' => 'Ali',
                'email' => 'Ali@a'
            ]]
        ];
        return view('excel.excel', $data);
    }
}
