<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    public function phones(): HasMany
    {
        return $this->hasMany(PhoneNumber::class);
    }

    public function company(): BelongsTo
    {
        return $this->BelongsTo(Company::class);
    }

    public function foodPreference(): BelongsTo
    {
        return $this->BelongsTo(FoodPreference::class);
    }
}
