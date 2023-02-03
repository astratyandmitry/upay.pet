<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $uuid
 * @property int $client_id
 * @property int $status_id
 * @property float $amount
 * @property string|null $description
 *
 * @property \Illuminate\Support\Carbon|null $paid_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 *
 * @property \App\Models\PaymentStatus $status
 * @property \App\Models\Client $client
 */
class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['status_id', 'amount', 'description'];

    public $dates = ['created_at', 'updated_at', 'paid_at'];

    public function status(): BelongsTo
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class)->withTrashed();
    }

    public function pay(): void
    {
        $this->status_id = PAYMENT_STATUS_PAID;
        $this->paid_at = now();
        $this->save();
    }

    public function cancel(): void
    {
        $this->status_id = PAYMENT_STATUS_CANCELED;
        $this->save();
    }

}
