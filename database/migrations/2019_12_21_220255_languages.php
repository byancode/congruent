<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Languages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->json('options')->default(new Expression('(JSON_OBJECT())'));
            $table->json('details')->default(new Expression('(JSON_OBJECT())'));
            // -------------------------------------
            $table->timestampsTz();
        });
        Schema::create('languageables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id');
            $table->integer('anguageable_id');
            $table->string ('anguageable_type', 100);
            $table->timestampsTz();
            # ---------------------------
            $table->unique([
                'language_id',
                'languageable_id',
                'languageable_type'
            ],  'languageable_unique');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
        Schema::dropIfExists('languageables');
    }
}
