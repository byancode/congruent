<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Messages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_id')->index();
            $table->string('subject');
            $table->morphs('subjectable');
            $table->integer('message_id')->nullable();
            $table->json('options')->default(new Expression('(JSON_OBJECT())'));
            $table->json('details')->default(new Expression('(JSON_OBJECT())'));
            $table->timestampsTz();
        });
        Schema::create('messageables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('message_id');
            $table->morphs('messageable');
            $table->timestampsTz();

            $table->unique([
                'message_id',
                'messageable_id',
                'messageable_type'
            ],  'messageable_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
        Schema::dropIfExists('messageables');
    }
}
