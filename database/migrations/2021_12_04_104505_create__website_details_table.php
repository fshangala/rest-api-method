<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_details', function (Blueprint $table) {
            $table->increments("id");
            $table->string("template_id");
            $table->string("website_business_name");
            $table->string("website_address_line_1");
            $table->string("website_address_line_2");
            $table->string("website_city");
            $table->string("website_state");
            $table->string("website_post_code");
            $table->string("website_phone");
            $table->string("website_email");
            $table->string("website_mobile");
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
        Schema::dropIfExists('website_details');
    }
}
