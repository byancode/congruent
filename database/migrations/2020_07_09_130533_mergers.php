<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Mergers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mergers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_id')->index();
            $table->morphs('author');
            $table->morphs('subjectable');
            $table->boolean('clip')->default(false);
            $table->timestampsTz();
            // -----------------------------
            $table->unique([
                'author_id',
                'author_type',
                'subjectable_id',
                'subjectable_type',
            ],  'merger_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mergers');
    }
}
