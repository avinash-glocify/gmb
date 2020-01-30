<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('project_id');
            $table->string('email')->unique();
            $table->string('recovery_mail')->nullable();
            $table->string('password')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('state_abrevation')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('worker_name')->nullable();
            $table->string('gmb_listing_name')->nullable();
            $table->string('bussiness_id')->nullable();
            $table->string('category_id')->nullable();
            $table->integer('store_code')->nullable();
            $table->string('business_name')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('address_line_3')->nullable();
            $table->string('address_line_4')->nullable();
            $table->string('address_line_5')->nullable();
            $table->string('sub_locality')->nullable();
            $table->string('locality')->nullable();
            $table->string('administrative_area')->nullable();
            $table->string('country_region')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('primary_phone')->nullable();
            $table->string('additional_phones')->nullable();
            $table->string('website')->nullable();
            $table->string('primary_category')->nullable();
            $table->string('additional_categories')->nullable();
            $table->string('sunday_hours')->nullable();
            $table->string('monday_hours')->nullable();
            $table->string('tuesday_hours')->nullable();
            $table->string('wednesday_hours')->nullable();
            $table->string('thursday_hours')->nullable();
            $table->string('friday_hours')->nullable();
            $table->string('saturday_hours')->nullable();
            $table->string('special_hours')->nullable();
            $table->longText('from_the_business')->nullable();
            $table->string('logo_photo')->nullable();
            $table->string('cover_photo')->nullable();
            $table->string('other_photos')->nullable();
            $table->string('labels')->nullable();
            $table->string('adwords_location_extensions_phone')->nullable();
            $table->string('amenities_wi_fi_wi_fi')->nullable();
            $table->string('highlights_women_led_is_owned_by_women')->nullable();
            $table->string('credit_card_american_express')->nullable();
            $table->string('credit_card_master_card')->nullable();
            $table->string('credit_card_visa')->nullable();
            $table->string('place_page_urls_menu_link_url_menu')->nullable();
            $table->string('opening_date')->nullable();
            $table->timestamp('creation_date')->nullable();
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
        Schema::dropIfExists('project_details');
    }
}
