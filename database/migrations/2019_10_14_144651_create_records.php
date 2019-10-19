<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('mname');
            $table->string('gender', 10);
            $table->date('birthdate');
            $table->integer('civil_status');
            $table->string('unique_id_num', 50);
            $table->string('address');
            $table->string('street');
            $table->integer('barangay');
            $table->string('profile_pic');
            $table->string('phone_num', 50)->default(null);
            $table->string('tel_num', 50)->default(null);
            $table->integer('status')->default(1)->comment("1=active;0=inactive");
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
        Schema::dropIfExists('records');
    }
}
