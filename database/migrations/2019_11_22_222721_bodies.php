<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Bodies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bodies', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text')->nullable();
            $table->morphs('subjectable');
            $table->integer('locale_id')->index();
            $table->json('data')->default(new Expression('(JSON_OBJECT())'));
            $table->timestampsTz();
            // -----------------------------------
            $table->unique([
                'locale_id',
                'subjectable_id',
                'subjectable_type',
            ],  'text_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bodies');
    }
}
