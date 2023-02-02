<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\PaymentRequest;
use App\Http\Resources\API\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PaymentsController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $payments = Payment::query()->with(['client', 'status'])->get();

        return PaymentResource::collection($payments);
    }

    public function store(PaymentRequest $request): PaymentResource
    {
        $payment = Payment::query()->create(
            $request->validated()
        );

        return new PaymentResource($payment);
    }

    public function show(int $id): PaymentResource
    {
        $payment = Payment::query()->with(['client', 'status'])->findOrFail($id);

        return new PaymentResource($payment);
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
