<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['bookfee', 'dpayment', 'rpayment'])->default('bookfee')->index();
            $table->double('amount', 8, 2)->default(0);
            $table->string('spelled')->nullable();
            $table->unsignedBigInteger('reservation_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->timestamps();

            $table->unique(['type', 'reservation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
