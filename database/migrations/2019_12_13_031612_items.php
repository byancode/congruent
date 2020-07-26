<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Items extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kind')->index();
            $table->string('type')->index();
            $table->string('name')->nullable();
            $table->string('value')->nullable();
            $table->dateTimeTz('index_at')->nullable();
            $table->morphs('subjectable');
            $table->timestampsTz();
        });
        Schema::create('itemables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->integer('itemable_id');
            $table->string('itemable_type', 100);
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
        Schema::dropIfExists('items');
        Schema::dropIfExists('itemables');
    }
}
