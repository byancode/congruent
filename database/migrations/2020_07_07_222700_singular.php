<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Singular extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('singulars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kind')->index();
            $table->string('name')->nullable();
            $table->nullableMorphs('subjectable');
            $table->json('profile')->default(new Expression('(JSON_OBJECT())'));
            $table->json('details')->default(new Expression('(JSON_OBJECT())'));
            $table->date('birthday')->nullable();
            $table->date('deathday')->nullable();
            $table->timestampsTz();
        });
        DB::statement("ALTER TABLE singulars AUTO_INCREMENT = 1000000001;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('singulars');
    }
}
