<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $fillable = [
        'description',
        'timestamp',
        'amount',
        'type',
        'user_id',
        'account_id',
        'category_id',
        'income_source_id',
        'currency_id',
        'created_at',
        'updated_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'currency_id');
    }

    public function incomeSource(): BelongsTo
    {
        return $this->belongsTo(IncomeSource::class, 'income_source_id');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
