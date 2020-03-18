<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Infection extends Model
{
    use SoftDeletes;

    public $table = 'infections';

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'report_date',
    ];

    protected $fillable = [
        'country_id',
        'infections',
        'created_at',
        'updated_at',
        'deleted_at',
        'report_date',
    ];

    public function getReportDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;

    }

    public function setReportDateAttribute($value)
    {
        $this->attributes['report_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;

    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');

    }
}
