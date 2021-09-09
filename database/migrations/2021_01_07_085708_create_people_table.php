<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('person_id')->nullable()->unique();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('suffix', 3)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('province_code')->nullable();
            $table->string('city_code')->nullable();
            $table->string('barangay_code')->nullable();
            $table->enum('gender', ['male', 'female'])->nullabe()->default('male');
            $table->text('temporary_address')->nullable();
            $table->text('address')->nullable();
            $table->integer('age')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('phone_number')->nullable()->unique();
            $table->string('landline_number')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->default('default.png');
            $table->string('photo_of_id')->default('*');
            $table->enum('status_of_residence', ['residence', 'non_residence'])->default('residence');
            $table->enum('registered_from', ['MOBILE', 'WEBSITE'])->default('WEBSITE');
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
        Schema::dropIfExists('people');
    }
}
