<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSMSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_m_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone_number');
            $table->longText('message')->nullable();
            $table->enum('status', ['active', 'in-active'])->default('active');
            $table->timestamps();
            // ->default("You are notified having been exposed to a COVID-19 positive suspect kindly submit and coordinate with your barangay health worker for guidance. \n" . "Thank you.\n");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_m_s');
    }
}
