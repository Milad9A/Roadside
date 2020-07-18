<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->enum('type', ['transport', 'tow', 'fuel', 'tire', 'battery'])->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('service_id')->unsigned();
            $table->string('status')->default('pending');
            $table->string('start_qr')->nullable();
            $table->string('end_qr')->nullable();
            $table->string('points')->nullable();
            $table->double('request_lat')->nullable();
            $table->double('request_long')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_services');
    }
}
