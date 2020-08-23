<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Reactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reactionables', function (Blueprint $table) {
            $table->id();
            $table->string('type_id', 100);
            $table->customMorphs('modelable', 100)->index();
            $table->customMorphs('relationable', 100)->index();
            $table->json('details')->default(new Expression('JSON_OBJECT()'));
            $table->timestampsTz();
            // -----------------------------
            $table->unique([
                'type_id',
                'modelable_id',
                'modelable_type',
                'relationable_type',
            ],  'reaction_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reactionables');
    }
}
