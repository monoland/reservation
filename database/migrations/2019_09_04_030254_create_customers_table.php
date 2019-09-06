<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index();
            $table->string('slug')->unique();
            $table->string('address')->nullable();
            $table->string('phone')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('contact_name')->nullable()->index();
            $table->string('contact_phone')->nullable()->index();
            $table->unsignedBigInteger('segment_id')->index();
            $table->unsignedBigInteger('marketing_id')->index();
            $table->unsignedBigInteger('district_id')->index();
            $table->unsignedBigInteger('regency_id')->index();
            $table->unsignedBigInteger('province_id')->index();
            $table->boolean('checked')->default(false);
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
        Schema::dropIfExists('customers');
    }
}
