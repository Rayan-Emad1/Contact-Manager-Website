<?php

// Migration file: create_users_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up(){
        
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
        });

        Schema::create('user_contacts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id_1');
            $table->foreign('user_id_1')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_id_2');
            $table->foreign('user_id_2')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });


    }

    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_contacts');
    }
}