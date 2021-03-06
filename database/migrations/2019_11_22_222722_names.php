<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Names extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('names', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->morphs('subjectable');
            $table->integer('locale_id')->index();
            $table->json('data')->default(new Expression('(JSON_OBJECT())'));
            $table->timestampsTz();
            // -----------------------------------
            $table->unique([
                'locale_id',
                'subjectable_id',
                'subjectable_type',
            ],  'name_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('names');
    }
}
