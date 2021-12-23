<?php

namespace App\Console\Schedule;

interface BackupDataInterface {
  public static function backup();
}

class BackupData implements BackupDataInterface {
  public static function backup() {
    echo 'World ';
    return 'Hello';
  }
}