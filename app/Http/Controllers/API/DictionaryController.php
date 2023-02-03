<?php

namespace App\Http\Controllers\API;

use App\Models\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\PaymentStatusResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DictionaryController extends Controller
{
    public function paymentStatuses(): AnonymousResourceCollection
    {
        $statuses = PaymentStatus::query()->get();

        return PaymentStatusResource::collection($statuses);
    }
}
