<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Statuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('type_id')->index();
            $table->customMorphs('author')->index();
            $table->customMorphs('subjectable')->index();
            $table->timestampsTz();
            // -----------------------------
            $table->index([
                'author_id',
                'author_type',
                'subjectable_id',
                'subjectable_type',
            ],  'status_index_1');
            # ----------------------
            $table->index([
                'type_id',
                'author_id',
                'author_type',
                'subjectable_id',
                'subjectable_type',
            ],  'status_index_2');
            # ----------------------
            $table->index([
                'type_id',
                'subjectable_id',
                'subjectable_type',
            ],  'status_index_3');
            # ----------------------
            $table->index([
                'type_id',
                'author_id',
                'author_type',
            ],  'status_index_4');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
