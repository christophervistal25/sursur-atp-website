<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateUserRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update_user_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('person_id');
            $table->json('fields');
            $table->string('from');
            $table->bigInteger('request_id');
            $table->enum('status', ['pending', 'reject', 'accept'])->default('pending');
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
        Schema::dropIfExists('update_user_requests');
    }
}
