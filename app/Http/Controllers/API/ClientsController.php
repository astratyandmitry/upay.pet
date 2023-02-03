<?php

namespace App\Http\Controllers\API;

use App\Models\Client;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ClientRequest;
use App\Http\Resources\API\ClientResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientsController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $clients = Client::query()->latest()->get();

        return ClientResource::collection($clients);
    }

    public function store(ClientRequest $request): JsonResponse
    {
        $client = Client::query()->create(
            $request->validated()
        );

        return response()->json([
            'message' => 'Client has been created',
            'client' =>  new ClientResource($client),
        ], 201);
    }

    public function show(int $id): ClientResource
    {
        $client = Client::query()->with(['payments', 'payments.status'])->findOrFail($id);

        return new ClientResource($client);
    }

    public function update(ClientRequest $request, int $id): JsonResponse
    {
        $client = Client::query()->findOrFail($id);
        $client->update(
            $request->validated()
        );

        return response()->json([
            'message' => 'Client has been updated',
            'client' =>  new ClientResource($client),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $client = Client::query()->findOrFail($id);
        $client->delete();

        return response()->json([
            'message' => 'Client has been deleted',
        ]);
    }
}
