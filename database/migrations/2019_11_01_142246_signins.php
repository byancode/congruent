<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;

class Signins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('type_id')->index();
            $table->string('password')->nullable();
            $table->string('confirmedEmail')->nullable();
            $table->timestampTz('email_verified_at')->nullable();
            $table->json('settings')->default(new Expression('(JSON_OBJECT())'));
            $table->json('security')->default(new Expression('(JSON_OBJECT())'));
            $table->json('profile')->default(new Expression('(JSON_OBJECT())'));
            $table->rememberToken();
            $table->timestampsTz();
        });
        DB::statement("ALTER TABLE signins AUTO_INCREMENT = 1000000001;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signins');
    }
}
