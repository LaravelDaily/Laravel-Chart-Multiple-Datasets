<?php

namespace App\Http\Requests;

use App\Infection;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateInfectionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('infection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'report_date' => [
                'required',
                'date_format:' . config('panel.date_format')],
            'infections'  => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647'],
        ];

    }
}
