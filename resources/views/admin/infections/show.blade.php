@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.infection.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.infections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.infection.fields.id') }}
                        </th>
                        <td>
                            {{ $infection->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.infection.fields.report_date') }}
                        </th>
                        <td>
                            {{ $infection->report_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.infection.fields.country') }}
                        </th>
                        <td>
                            {{ $infection->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.infection.fields.infections') }}
                        </th>
                        <td>
                            {{ $infection->infections }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.infections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection