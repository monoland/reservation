<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('authent_id')->references('id')->on('authents')->onDelete('cascade');
        });

        Schema::table('oauth_auth_codes', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete(('cascade'));
            $table->foreign('client_id')->references('id')->on('oauth_clients')->onDelete(('cascade'));
        });

        Schema::table('oauth_access_tokens', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete(('cascade'));
            $table->foreign('client_id')->references('id')->on('oauth_clients')->onDelete(('cascade'));
        });

        Schema::table('oauth_refresh_tokens', function(Blueprint $table) {
            $table->foreign('access_token_id')->references('id')->on('oauth_access_tokens')->onDelete(('cascade'));
        });

        Schema::table('oauth_clients', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete(('cascade'));
        });

        Schema::table('oauth_personal_access_clients', function(Blueprint $table) {
            $table->foreign('client_id')->references('id')->on('oauth_clients')->onDelete(('cascade'));
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete(('cascade'));
        });

        Schema::table('documentables', function (Blueprint $table) {
            $table->foreign('document_id')->references('id')->on('documents')->onDelete(('cascade'));
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('segment_id')->references('id')->on('segments')->onDelete(('cascade'));
            $table->foreign('marketing_id')->references('id')->on('marketings')->onDelete(('cascade'));
            $table->foreign('district_id')->references('id')->on('districts')->onDelete(('cascade'));
            $table->foreign('regency_id')->references('id')->on('regencies')->onDelete(('cascade'));
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete(('cascade'));
        });

        Schema::table('regencies', function (Blueprint $table) {
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete(('cascade'));
        });

        Schema::table('districts', function (Blueprint $table) {
            $table->foreign('regency_id')->references('id')->on('regencies')->onDelete(('cascade'));
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete(('cascade'));
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete(('cascade'));
        });

        Schema::table('monetizes', function (Blueprint $table) {
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete(('cascade'));
            $table->foreign('segment_id')->references('id')->on('segments')->onDelete(('cascade'));
        });

        Schema::table('pricelists', function (Blueprint $table) {
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete(('cascade'));
            $table->foreign('segment_id')->references('id')->on('segments')->onDelete(('cascade'));
        });

        Schema::table('item_pricelist', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items')->onDelete(('cascade'));
            $table->foreign('pricelist_id')->references('id')->on('pricelists')->onDelete(('cascade'));
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete(('cascade'));
            $table->foreign('segment_id')->references('id')->on('segments')->onDelete(('cascade'));
            $table->foreign('marketing_id')->references('id')->on('marketings')->onDelete(('cascade'));
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete(('cascade'));
            $table->foreign('user_id')->references('id')->on('users')->onDelete(('cascade'));
        });

        Schema::table('pricelist_reservation', function (Blueprint $table) {
            $table->foreign('pricelist_id')->references('id')->on('pricelists')->onDelete(('cascade'));
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete(('cascade'));
        });

        Schema::table('followups', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete(('cascade'));
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete(('cascade'));
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete(('cascade'));
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete(('cascade'));
        });

        Schema::table('rundowns', function (Blueprint $table) {
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete(('cascade'));
        });

        Schema::table('employee_reservation', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete(('cascade'));
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete(('cascade'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 
    }
}
