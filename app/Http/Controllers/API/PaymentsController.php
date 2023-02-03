<?php

namespace App\Http\Controllers\API;

use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\PaymentResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentsController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $payments = Payment::query()->with(['client', 'status'])->latest()->get();

        return PaymentResource::collection($payments);
    }

    public function paid(int $id): JsonResponse
    {
        /** @var \App\Models\Payment $payment */
        $payment = Payment::query()->findOrFail($id);

        if ($payment->status_id !== PAYMENT_STATUS_PENDING) {
            return response()->json([
                'message' => 'Payment is not pending',
            ], 422);
        }

        $payment->pay();

        return response()->json([
            'message' => 'Payment has been paid',
        ]);
    }

    public function canceled(int $id): JsonResponse
    {
        /** @var \App\Models\Payment $payment */
        $payment = Payment::query()->findOrFail($id);

        if ($payment->status_id !== PAYMENT_STATUS_PENDING) {
            return response()->json([
                'message' => 'Payment is not pending',
            ], 422);
        }

        $payment->cancel();

        return response()->json([
            'message' => 'Payment has been canceled',
        ]);
    }
}
