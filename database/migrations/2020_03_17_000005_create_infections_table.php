<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfectionsTable extends Migration
{
    public function up()
    {
        Schema::create('infections', function (Blueprint $table) {
            $table->increments('id');
            $table->date('report_date');
            $table->integer('infections');
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
