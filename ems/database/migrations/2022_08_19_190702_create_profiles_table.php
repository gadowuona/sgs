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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('staffid')->unique();
            $table->string('first_name', 20);
            $table->string('middle_name')->nullable();
            $table->string('last_name', 20);
            $table->date('birthdate');
            $table->enum('gender', ['male', 'female']);
            $table->string('phone1', 15)->nullable();
            $table->string('phone2', 15)->nullable();
            $table->string('nid')->unique();
            $table->string('address');
            $table->string('collage');
            $table->enum('fns', ['Faculty', 'School']);
            $table->string('department');
            $table->string('qualification');
            $table->text('picture');
            $table->string('super_status')->nullable();
            $table->date('doa')->nullable();
            $table->string('faculty')->nullable();
            $table->string('school')->nullable();
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
        Schema::dropIfExists('profiles');
    }
};