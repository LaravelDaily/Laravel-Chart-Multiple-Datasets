<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyInfectionRequest;
use App\Http\Requests\StoreInfectionRequest;
use App\Http\Requests\UpdateInfectionRequest;
use App\Infection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InfectionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('infection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $infections = Infection::all();

        return view('admin.infections.index', compact('infections'));
    }

    public function create()
    {
        abort_if(Gate::denies('infection_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.infections.create', compact('countries'));
    }

    public function store(StoreInfectionRequest $request)
    {
        $infection = Infection::create($request->all());

        return redirect()->route('admin.infections.index');

    }

    public function edit(Infection $infection)
    {
        abort_if(Gate::denies('infection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $infection->load('country');

        return view('admin.infections.edit', compact('countries', 'infection'));
    }

    public function update(UpdateInfectionRequest $request, Infection $infection)
    {
        $infection->update($request->all());

        return redirect()->route('admin.infections.index');

    }

    public function show(Infection $infection)
    {
        abort_if(Gate::denies('infection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $infection->load('country');

        return view('admin.infections.show', compact('infection'));
    }

    public function destroy(Infection $infection)
    {
        abort_if(Gate::denies('infection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $infection->delete();

        return back();

    }

    public function massDestroy(MassDestroyInfectionRequest $request)
    {
        Infection::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
