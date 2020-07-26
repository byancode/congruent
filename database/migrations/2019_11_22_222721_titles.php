<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Titles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->morphs('subjectable');
            $table->integer('locale_id')->index();
            $table->json('meta')->default(new Expression('(JSON_OBJECT())'));
            $table->timestampsTz();
            // -----------------------------------
            $table->unique([
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
        Schema::dropIfExists('titles');
    }
}
