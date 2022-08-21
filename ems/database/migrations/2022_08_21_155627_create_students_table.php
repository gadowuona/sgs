<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('index_number', 20)->unique();
            $table->string('first_name', 20);
            $table->string('middle_name')->nullable();
            $table->string('last_name', 20);
            $table->string('email')->unique();
            $table->string('programme');
            $table->enum('gender', ['male', 'female']);
            $table->string('phone1', 15);
            $table->string('phone2', 15)->nullable();
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
        Schema::dropIfExists('students');
    }
};