<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileDocument extends Model
{
    protected $table = 'file_documents';

    protected $fillable = [
        'userId',
        'fileId',
        'file',
    ];
    public function gallery()
    {
        return $this->belongsTo(albums::class, 'fileId');
    }
}
