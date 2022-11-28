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
            $table->string('email')->unique();
            $table->string('password');   
            $table->string('mobile', 20)->nullable(); 
            $table->string('whatsapp', 20)->nullable(); 
            $table->tinyInteger('status')->default(0);
            $table->date('last_login');
            $table->tinyInteger('type')->comment('1 for Host, 2 for Customer');
            $table->string('profile_pic', 250)->nullable();
            $table->string('operator', 10)->nullable();
            $table->string('provider', 100)->nullable();
            $table->string('provider_id', 100)->nullable();
            $table->string('device_id', 100)->nullable();
            $table->string('view_pass');   
            $table->timestamp('email_verified_at')->nullable();
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
