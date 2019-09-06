<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRundownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rundowns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_str')->nullable()->index();
            $table->time('time_str')->nullable()->index();
            $table->time('time_end')->nullable()->index();
            $table->text('activity');
            $table->unsignedBigInteger('reservation_id')->nullable()->index();
            $table->timestamps();
        });

        Schema::create('employee_reservation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id')->index();
            $table->unsignedBigInteger('reservation_id')->index();
            $table->timestamps();

            $table->unique(['employee_id', 'reservation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rundowns');
        Schema::dropIfExists('employee_reservation');
    }
}
