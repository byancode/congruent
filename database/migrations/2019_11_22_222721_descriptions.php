<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Descriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('type_id');
            $table->text('body')->nullable();
            $table->integer('locale_id')->index();
            $table->morphs('subjectable');
            $table->json('data')->default(new Expression('(JSON_OBJECT())'));
            $table->timestampsTz();
            
            $table->unique([
                'locale_id',
                'subjectable_id',
                'subjectable_type',
            ],  'description_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('descriptions');
    }
}
