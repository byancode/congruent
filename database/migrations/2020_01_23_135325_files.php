<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Files extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string ('disk');
            $table->string ('link');
            $table->string ('path');
            $table->string ('name');
            $table->string ('mime');
            $table->integer('size');
            $table->string ('extension');
            $table->bigInteger('type_id')->index();
            $table->string ('visibility')->nullable();
            $table->customMorphs('fileable')->index();
            $table->json   ('details')->default('{}');
            $table->json   ('options')->default('{}');
            $table->json   ('loggers')->default('{}');
            # ---------------------------
            $table->timestampsTz();
            # ---------------------------
            $table->index([
                'type_id',
                'fileable_id',
                'fileable_type'
            ],  'fileable_index_1');
            # ---------------------------
            $table->index([
                'fileable_id',
                'fileable_type'
            ],  'fileable_index_2');
            # ---------------------------
            $table->index([
                'type_id',
                'fileable_id',
                'fileable_type'
            ],  'fileable_index_3');
            # ---------------------------
            $table->index([
                'fileable_id',
                'fileable_type'
            ],  'fileable_index_4');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
