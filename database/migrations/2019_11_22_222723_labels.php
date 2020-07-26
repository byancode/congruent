<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Labels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->morphs('subjectable');
            $table->json('meta')->default(new Expression('(JSON_OBJECT())'));
            $table->timestampsTz();
            // -----------------------------------
            $table->index([
                'locale_id',
                'subjectable_id',
                'subjectable_type',
            ],  'label_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labels');
    }
}