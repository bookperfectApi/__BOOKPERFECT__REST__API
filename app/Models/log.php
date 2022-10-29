<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class log extends Model
{
    use HasFactory;
    protected $table = "logTable";
    protected $fillable = [
        'requestName', 
        'IP',
        'status',
        'date',
    ];
}
