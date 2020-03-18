<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInfectionRequest;
use App\Http\Requests\UpdateInfectionRequest;
use App\Http\Resources\Admin\InfectionResource;
use App\Infection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InfectionsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('infection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InfectionResource(Infection::with(['country'])->get());

    }

    public function store(StoreInfectionRequest $request)
    {
        $infection = Infection::create($request->all());

        return (new InfectionResource($infection))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Infection $infection)
    {
        abort_if(Gate::denies('infection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InfectionResource($infection->load(['country']));

    }

    public function update(UpdateInfectionRequest $request, Infection $infection)
    {
        $infection->update($request->all());

        return (new InfectionResource($infection))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Infection $infection)
    {
        abort_if(Gate::denies('infection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $infection->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
