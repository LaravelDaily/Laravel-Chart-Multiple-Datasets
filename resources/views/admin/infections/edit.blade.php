@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.infection.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.infections.update", [$infection->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="report_date">{{ trans('cruds.infection.fields.report_date') }}</label>
                <input class="form-control date {{ $errors->has('report_date') ? 'is-invalid' : '' }}" type="text" name="report_date" id="report_date" value="{{ old('report_date', $infection->report_date) }}" required>
                @if($errors->has('report_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('report_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.infection.fields.report_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country_id">{{ trans('cruds.infection.fields.country') }}</label>
                <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country_id" id="country_id">
                    @foreach($countries as $id => $country)
                        <option value="{{ $id }}" {{ ($infection->country ? $infection->country->id : old('country_id')) == $id ? 'selected' : '' }}>{{ $country }}</option>
                    @endforeach
                </select>
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.infection.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="infections">{{ trans('cruds.infection.fields.infections') }}</label>
                <input class="form-control {{ $errors->has('infections') ? 'is-invalid' : '' }}" type="number" name="infections" id="infections" value="{{ old('infections', $infection->infections) }}" step="1" required>
                @if($errors->has('infections'))
                    <div class="invalid-feedback">
                        {{ $errors->first('infections') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.infection.fields.infections_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection