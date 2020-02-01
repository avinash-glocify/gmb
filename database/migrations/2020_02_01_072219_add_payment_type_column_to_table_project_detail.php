<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentTypeColumnToTableProjectDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_details', function (Blueprint $table) {
            $table->string('payment_type')->after('final_status')->nullable();
            $table->string('referred_by')->after('payment_type')->nullable();
            $table->string('payment_id')->after('referred_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_details', function (Blueprint $table) {
          $table->dropColumn('payment_type');
          $table->dropColumn('referred_by');
          $table->dropColumn('payment_id');
        });
    }
}
