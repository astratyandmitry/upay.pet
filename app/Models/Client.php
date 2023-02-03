<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property string $phone
 *
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $deleted_at
 *
 * @property \App\Models\Payment[]|\Illuminate\Database\Eloquent\Collection $payments
 */
class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['full_name', 'email', 'phone'];

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
