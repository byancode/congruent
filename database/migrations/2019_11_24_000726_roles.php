<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Roles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('type_id')->index();
            $table->json('options')->default(new Expression('(JSON_OBJECT())'));
            $table->json('details')->default(new Expression('(JSON_OBJECT())'));
            $table->timestampsTz();
            # ------------------------
            $table->unique([
                'name',
                'type_id'
            ],  'role_unique');
        });
        Schema::create('roleables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id');
            $table->integer('roleable_id');
            $table->string( 'roleable_type', 100);
            $table->timestampsTz();
            // ------------------------------------
            $table->unique([
                'role_id',
                'roleable_id',
                'roleable_type'
            ],  'roleable_unique');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('roleables');
    }
}
