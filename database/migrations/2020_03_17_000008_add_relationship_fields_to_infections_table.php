<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInfectionsTable extends Migration
{
    public function up()
    {
        Schema::table('infections', function (Blueprint $table) {
            $table->unsignedInteger('country_id')->nullable();
            $table->foreign('country_id', 'country_fk_1156566')->references('id')->on('countries');
        });

    }
}
