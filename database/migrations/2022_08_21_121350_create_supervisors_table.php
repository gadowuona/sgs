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
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('staffid')->unique();
            $table->enum('title', ['Prof.', 'Dr.', 'Rev.', 'Mr.', 'Mrs.', 'Miss', 'Ms.']);
            $table->string('first_name', 20);
            $table->string('middle_name')->nullable();
            $table->string('last_name', 20);
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('phone1', 15)->nullable();
            $table->string('phone2', 15)->nullable();
            $table->string('nid')->unique();
            $table->string('address')->nullable();
            $table->string('collage');
            $table->enum('fns', ['Faculty', 'School']);
            $table->string('faculty_school')->nullable();
            $table->string('department');
            $table->string('qualification');
            $table->date('doa')->nullable();
            $table->text('picture')->nullable();
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
        Schema::dropIfExists('supervisors');
    }
};