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
            $table->json('details')->default(new Expression('JSON_OBJECT()'));
            $table->timestampsTz();
            // -----------------------------
            $table->index([
                'author_id',
                'author_type',
                'subjectable_id',
                'subjectable_type',
            ],  'activity_index_1');
            # ----------------------
            $table->index([
                'type_id',
                'author_id',
                'author_type',
                'subjectable_id',
                'subjectable_type',
            ],  'activity_index_2');
            # ----------------------
            $table->index([
                'type_id',
                'subjectable_id',
                'subjectable_type',
            ],  'activity_index_3');
            # ----------------------
            $table->index([
                'type_id',
                'author_id',
                'author_type',
            ],  'activity_index_4');
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
