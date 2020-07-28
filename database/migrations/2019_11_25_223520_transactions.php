<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Transactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string( 'kind', 70);
            $table->uuid  ( 'txid')->default(new Expression('UUID()'))->unique();
            $table->string( 'currency_code', 100)->index();
            $table->decimal('amount', 15, 8)->default('0');
            $table->string ('label', 100)->nullable()->index();
            $table->string ('message')->nullable();
            $table->customMorphs('author',      ['string' => 70, 'index' => 'w92YSC']);
            $table->customMorphs('subjectable', ['string' => 70, 'index' => 'EI8wm8']);
            $table->json('details')->default(new Expression('JSON_OBJECT()'));
            $table->timestampsTz();
            // ------------------------------------
            $table->index([
                'currency_code',
                'author_id',
                'author_type'
            ],  'HcaSh7');
            // ------------------------------------
            $table->index([
                'currency_code',
                'subjectable_id',
                'subjectable_type'
            ],  'cqkpEq');
            // ------------------------------------
            $table->index([
                'kind',
                'currency_code',
                'author_id',
                'author_type'
            ],  'NRwAYE');
            // ------------------------------------
            $table->index([
                'kind',
                'currency_code',
                'subjectable_id',
                'subjectable_type'
            ],  'sRY9lM');
        });
        # ---------------------------------------------------------------------
        DB::statement("ALTER TABLE transactions AUTO_INCREMENT = 1000000001;");
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
