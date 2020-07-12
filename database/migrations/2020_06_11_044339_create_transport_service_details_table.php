<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportServiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_service_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('load_city')->nullable();
            $table->string('load_address')->nullable();
            $table->string('load_address_lat')->nullable();
            $table->string('load_address_long')->nullable();
            $table->string('down_city')->nullable();
            $table->string('down_address')->nullable();
            $table->string('down_address_lat')->nullable();
            $table->string('down_address_long')->nullable();
            $table->unsignedInteger('request_services_id');
            $table->foreign('request_services_id')->references('id')->on('request_services');
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
        Schema::dropIfExists('transport_service_details');
    }
}
