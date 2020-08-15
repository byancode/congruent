<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Activities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('type_id', 100)->index();
            $table->customMorphs('author', 100)->index();
            $table->customMorphs('subjectable', 100)->index();
            $table->timestampsTz();
            // -----------------------------
            $table->unique([
                'type_id',
                'author_id',
                'author_type',
                'subjectable_id',
                'subjectable_type',
            ],  'activity_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
