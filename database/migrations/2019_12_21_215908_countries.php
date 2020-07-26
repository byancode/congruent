<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Countries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->json('options')->default(new Expression('(JSON_OBJECT())'));
            $table->json('details')->default(new Expression('(JSON_OBJECT())'));
            // -------------------------------------
            $table->timestampsTz();
        });
        Schema::create('countrables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id');
            $table->integer('countrable_id');
            $table->string ('countrable_type', 100);
            $table->timestampsTz();
            # ---------------------------
            $table->unique([
                'country_id',
                'countrable_id',
                'countrable_type'
            ],  'countrable_unique');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
        Schema::dropIfExists('countrables');
    }
}
