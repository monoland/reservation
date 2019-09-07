<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->index();
            $table->date('date_str')->nullable()->index();
            $table->time('time_str')->nullable()->index();
            $table->date('date_end')->nullable()->index();
            $table->time('time_end')->nullable()->index();
            $table->unsignedInteger('participants')->default(0);
            $table->string('contact_name')->nullable()->index();
            $table->string('contact_phone')->nullable()->index();
            $table->double('subtotal', 8, 2)->unsigned()->default(0);
            $table->double('discount', 8, 2)->unsigned()->default(0);
            $table->double('tax', 8, 2)->unsigned()->default(0);
            $table->double('marktfee', 8, 2)->unsigned()->default(0);
            $table->double('mangrfee', 8, 2)->unsigned()->default(0);
            $table->double('venuefee', 8, 2)->unsigned()->default(0);
            $table->enum('status', [
                'prospect', 'prospect-dropped', 'visit', 'visit-dropped', 'reserved', 'canceled', 'ongoing', 'completed'
            ])->index()->default('prospect');
            $table->text('feedback')->nullable();
            $table->text('reason')->nullable();
            $table->boolean('checked')->default(false);
            $table->boolean('locked')->default(false);
            $table->boolean('bookfee')->default(false);
            $table->boolean('dpayment')->default(false);
            $table->boolean('rpayment')->default(false);
            $table->boolean('rundown')->default(false);
            $table->unsignedBigInteger('marketing_id')->nullable()->index();
            $table->unsignedBigInteger('customer_id')->index();
            $table->unsignedBigInteger('venue_id')->nullable()->index();
            $table->unsignedBigInteger('segment_id')->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('pricelist_reservation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pricelist_id')->index();
            $table->unsignedBigInteger('reservation_id')->index();
            $table->string('name')->nullable()->index();
            $table->unsignedInteger('qty')->default(0);
            $table->double('price', 8, 2)->unsigned()->default(0);
            $table->double('amount', 8, 2)->unsigned()->default(0);
            $table->text('note')->nullable();
            $table->timestamps();

            $table->unique(['pricelist_id', 'reservation_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('pricelist_reservation');
    }
}
