<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Currencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kind')->index();
            $table->string('code')->unique();
            $table->string('symbol')->nullable();
            $table->integer('decimal')->default(0);
            $table->integer('country_id')->nullable();
            $table->json('options')->default(new Expression('(JSON_OBJECT())'));
            $table->json('details')->default(new Expression('(JSON_OBJECT())'));
            $table->timestampsTz();
        });
        // ------------------------------------------------------------------
        Schema::create('exchanges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('currency_id')->nullable();
            $table->string('to')->nullable();
            $table->decimal('rate', 15, 8);
            $table->decimal('fee', 10, 2)->default('0');
            $table->decimal('fix', 15, 8)->default('0');
            $table->timestampsTz();
            // ------------------------------------
            $table->unique([
                'currency',
                'to',
            ], 'exchange_unique');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchanges');
        Schema::dropIfExists('currencies');
    }
}
