<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';
    protected $fillable=[
        "account_name",
        "balance",
        "user_id",
        "income_sources_id",
        "created_at",
        "updated_at",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function incomeSource(): BelongsTo
    {
        return $this->belongsTo(IncomeSource::class, 'income_sources_id');
    }
}
