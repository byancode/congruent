<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Categories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('type_id')->index();
            $table->integer('parent_id')->nullable()->index();
            $table->json('options')->default(new Expression('JSON_OBJECT()'));
            $table->json('details')->default(new Expression('JSON_OBJECT()'));
            $table->timestampsTz();
        });
        Schema::create('categorizables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->integer('categorizable_id');
            $table->string('categorizable_type', 100);
            $table->timestampsTz();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('categorizables');
    }
}
