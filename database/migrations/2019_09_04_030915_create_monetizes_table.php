<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonetizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monetizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('operational', 8, 2)->unsigned()->default(0);
            $table->float('facility', 8, 2)->unsigned()->default(0);
            $table->float('salary', 8, 2)->unsigned()->default(0);
            $table->float('margin', 8, 2)->unsigned()->default(0);
            $table->float('discount', 8, 2)->unsigned()->default(0);
            $table->float('commission', 8, 2)->unsigned()->default(0);
            $table->float('marketfee', 8, 2)->unsigned()->default(0);
            $table->float('managerfee', 8, 2)->unsigned()->default(0);
            $table->float('venuefee', 8, 2)->unsigned()->default(0);
            $table->unsignedBigInteger('segment_id')->index();
            $table->unsignedBigInteger('venue_id')->index();
            $table->enum('type', ['package', 'item'])->index()->default('item');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monetizes');
    }
}
