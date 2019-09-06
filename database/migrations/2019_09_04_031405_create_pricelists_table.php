<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricelistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricelists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index();
            $table->string('slug')->index();
            $table->double('bprice', 8, 2)->default(0);
            $table->double('operational', 8, 2)->default(0);
            $table->double('facility', 8, 2)->default(0);
            $table->double('salary', 8, 2)->default(0);
            $table->double('margin', 8, 2)->default(0);
            $table->double('discount', 8, 2)->default(0);
            $table->double('commission', 8, 2)->default(0);
            $table->double('sprice', 8, 2)->default(0);
            $table->unsignedBigInteger('item_id')->nullable()->index();
            $table->enum('type', ['package', 'item'])->index()->default('item');
            $table->unsignedBigInteger('segment_id')->index();
            $table->unsignedBigInteger('venue_id')->index();
            $table->timestamps();

            $table->unique(['slug', 'segment_id', 'venue_id']);
        });

        Schema::create('item_pricelist', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_id')->index();
            $table->unsignedBigInteger('pricelist_id')->index();
            $table->string('name')->index();
            $table->double('price', 8, 2)->default(0);
            $table->timestamps();

            $table->unique(['item_id', 'pricelist_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricelists');
        Schema::dropIfExists('item_pricelist');
    }
}
