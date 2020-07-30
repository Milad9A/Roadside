<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('status')->default('sent')->nullable();
            $table->decimal('price',8,2)->nullable();
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('request_service_id');
            $table->unsignedInteger('owner_request_id');
            $table->unsignedInteger('company_id');
            $table->timestamps();

            $table->foreign('owner_request_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('request_service_id')->references('id')->on('request_services')->onDelete('cascade');
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
        Schema::dropIfExists('offer_requests');
    }
}
