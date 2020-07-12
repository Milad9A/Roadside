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
            $table->string('customer_id');
            $table->enum('type',['transport','tow','fuel','tire','battery'])->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('service_id');
            $table->string('status')->default('pending');
            $table->string('start_qr')->nullable();
            $table->string('end_qr')->nullable();
            $table->string('points')->nullable();
            $table->double('request_lat')->nullable();
            $table->double('request_long')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('request_services');
    }
}
