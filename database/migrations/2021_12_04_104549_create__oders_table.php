<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments("id");
            $table->string("partner");
            $table->string("type");
            $table->string("submitted_by");
            $table->string("company_id");
            $table->string("company_name");
            $table->string("contact_first_name")->nullable();
            $table->string("contact_last_name")->nullable();
            $table->string("contact_title")->nullable();
            $table->string("contact_phone")->nullable();
            $table->string("contact_mobile")->nullable();
            $table->string("contact_email")->nullable();
            $table->string("exposure_id")->nullable();
            $table->string("udac")->nullable();
            $table->string("related_order")->nullable();
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
        Schema::dropIfExists('orders');
    }
}
