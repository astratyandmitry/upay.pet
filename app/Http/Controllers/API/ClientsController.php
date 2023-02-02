<?php

namespace App\Http\Controllers\API;

use App\Models\Client;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\ClientRequest;
use App\Http\Resources\API\ClientResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientsController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $clients = Client::query()->get();

        return ClientResource::collection($clients);
    }

    public function store(ClientRequest $request): ClientResource
    {
        $client = Client::query()->create(
            $request->validated()
        );

        return new ClientResource($client);
    }

    public function show(int $id): ClientResource
    {
        $client = Client::query()->findOrFail($id);

        return new ClientResource($client);
    }

    public function update(ClientRequest $request, int $id): ClientResource
    {
        $client = Client::query()->findOrFail($id);
        $client->update(
            $request->validated()
        );

        return new ClientResource($client);
    }

    public function destroy(int $id): Response
    {
        $client = Client::query()->findOrFail($id);
        $client->delete();

        return response()->noContent();
    }
}
