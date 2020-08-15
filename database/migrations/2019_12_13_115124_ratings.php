<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ratings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('author_id');
            $table->string ('author_type', 100);
            $table->integer('ratingable_id');
            $table->string ('ratingable_type', 100);
            $table->integer('max_rating');
            $table->double( 'rating', 8, 2)->default(0);
            $table->timestampsTz();
            // ------------------------------------
            $table->unique([
                'ratingable_id',
                'ratingable_type',
                'author_id',
                'author_type',
            ],  'rating_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
