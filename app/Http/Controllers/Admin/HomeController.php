<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'Cases by Country and Date',
            'chart_type'            => 'line',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\\Infection',
            'conditions'            => [
                ['name' => 'Lithuania (2.79 mln people)', 'condition' => 'country_id = 121', 'color' => 'green'],
                ['name' => 'Latvia (1.92 mln people)', 'condition' => 'country_id = 115', 'color' => 'blue'],
                ['name' => 'Estonia (1.33 mln people)', 'condition' => 'country_id = 67', 'color' => 'red'],
            ],
            'group_by_field'        => 'report_date',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'infections',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'Y-m-d',
            'column_class'          => 'col-md-12',
            'entries_number'        => '5',
        ];

        $chart1 = new LaravelChart($settings1);

        return view('home', compact('chart1'));
    }
}
