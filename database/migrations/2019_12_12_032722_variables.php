<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Variables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variables', function (Blueprint $table) {
            $table->id();
            $table->string('type_id')->index();
            $table->string('key')->index();
            $table->json('value')->nullable();
            $table->customMorphs('author')->index();
            $table->timestampsTz();
            // ------------------------------------
            $table->unique([
                'key',
                'type_id',
                'author_id',
                'author_type',
            ],  'variable_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variables');
    }
}
