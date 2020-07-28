<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Exchanges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ------------------------------------------------------------------
        Schema::create('exchanges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('from_currency_code')->nullable();
            $table->string('to_currency_code')->nullable();
            $table->boolean('active');
            $table->timestampsTz();
            // ------------------------------------
            $table->unique([
                'from_currency_code',
                'to_currency_code',
            ],  'exchange_unique');
        });

        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('exchange_id');
            $table->decimal('rate', 15, 8);
            $table->decimal('fee', 10, 2)->default('0');
            $table->decimal('fix', 15, 8)->default('0');
            $table->timestampsTz();
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
        Schema::dropIfExists('exchange_rates');
    }
}
