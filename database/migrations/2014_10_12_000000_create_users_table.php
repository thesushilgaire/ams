<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('id_card_number')->nullable();
            $table->string('degination')->nullable();
            $table->string('joining_date')->nullable();
            $table->string('shift_id')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('bank_account')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
