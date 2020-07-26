<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Biographies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biographies', function (Blueprint $table) {
            $table->increments('id');
            $table->text('biography')->nullable();
            $table->integer('locale_id')->index();
            $table->morphs('subjectable');
            $table->json('meta')->default(new Expression('(JSON_OBJECT())'));
            $table->timestampsTz();
            
            $table->unique([
                'locale_id',
                'subjectable_id',
                'subjectable_type',
            ],  'biography_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biographies');
    }
}
