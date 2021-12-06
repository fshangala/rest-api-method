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
        Schema::create('oders', function (Blueprint $table) {
            $table->increments("id");
            $table->string("partner");
            $table->string("type");
            $table->string("submitted_by");
            $table->string("company_id");
            $table->string("company_name");
            $table->string("contact_first_name")->null();
            $table->string("contact_last_name")->null();
            $table->string("contact_title")->null();
            $table->string("contact_phone")->null();
            $table->string("contact_mobile")->null();
            $table->string("contact_email")->null();
            $table->string("exposure_id")->null();
            $table->string("udac")->null();
            $table->string("related_order")->null();
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
        Schema::dropIfExists('oders');
    }
}
