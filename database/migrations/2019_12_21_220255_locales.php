<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Locales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('script_code')->index();
            $table->string('country_code')->index();
            $table->string('language_code')->index();
            $table->string('variants')->nullable();
            // -------------------------------------
            $table->timestampsTz();
        });
        Schema::create('localables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('locale_id');
            $table->integer('localable_id');
            $table->string ('localable_type', 100);
            $table->timestampsTz();
            # ---------------------------
            $table->unique([
                'locale_id',
                'localable_id',
                'localable_type'
            ],  'localable_unique');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locales');
        Schema::dropIfExists('localables');
    }
}
