<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Alternative_titles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternative_titles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->morphs('subjectable');
            $table->integer('locale_id')->index();
            $table->json('meta')->default(new Expression('(JSON_OBJECT())'));
            $table->timestampsTz();
            // -----------------------------------
            $table->index([
                'locale_id',
                'subjectable_id',
                'subjectable_type',
            ],  'title_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alternative_titles');
    }
}
