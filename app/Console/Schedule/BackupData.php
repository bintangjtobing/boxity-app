<?php

namespace App\Console\Schedule;

use App\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BackupDataExcel;
use Illuminate\Support\Str;

interface BackupDataInterface
{
  public static function backup();
}

class BackupData implements BackupDataInterface
{
  public static function backup()
  {
    $path = 'excel/'.Str::random(15).'.xlsx';
    Excel::store(new BackupDataExcel, $path, 'local');
    return 'Hello';
  }
}
