<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'currencies';
    protected $fillable = [
        'currency_name',
        'symbol',
        'code',
        'created_at',
        'updated_at',
    ];
}
