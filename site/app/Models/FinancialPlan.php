<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinancialPlan extends Model
{
    use HasFactory;

    protected $table = 'financial_plan';

    protected $dates = ['date', 'created_at', 'updated_at'];
    protected $fillable = [
        'amount',
        'date',
        'user_id',
        'category_id',
        'currency_id',
        'created_at',
        'updated_at',
        ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function currency():BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
