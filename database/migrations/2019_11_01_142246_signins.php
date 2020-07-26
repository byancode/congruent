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
            $table->bigIncrements('id');
            $table->string('kind')->index();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password')->nullable();
            $table->string('displayName')->nullable();
            $table->string('confirmedEmail')->nullable();
            $table->integer('country_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
