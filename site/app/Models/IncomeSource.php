<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IncomeSource extends Model
{
    use HasFactory;

    protected $table = 'income_sources';
    protected $fillable=[
        "income_sources_name",
        "user_id",
        "created_at",
        "updated_at",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function account():HasMany{
        return $this->hasMany(Account::class);
    }

    public function transaction():HasMany{
        return $this->hasMany(Transaction::class);
    }
}
