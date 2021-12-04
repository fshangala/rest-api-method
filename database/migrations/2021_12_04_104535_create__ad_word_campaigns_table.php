<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdWordCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_word_campaigns', function (Blueprint $table) {
            $table->increments("id");
            $table->string("campaign_name");
            $table->string("campaign_address_line_1");
            $table->string("campaign_address_line_2");
            $table->string("campaign_address_post_number");
            $table->string("campaign_address_phone_number");
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
        Schema::dropIfExists('ad_word_campaigns');
    }
}
