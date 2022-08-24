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
        Schema::table('supervisors', function (Blueprint $table) {
            $table->enum('title', ['Prof.', 'Dr.', 'Rev.', 'Mr.', 'Mrs.', 'Miss', 'Ms.']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supervisors', function (Blueprint $table) {
            $table->enum('title', ['Prof.', 'Dr.', 'Rev.', 'Mr.', 'Mrs.', 'Miss', 'Ms.']);
        });
    }
};