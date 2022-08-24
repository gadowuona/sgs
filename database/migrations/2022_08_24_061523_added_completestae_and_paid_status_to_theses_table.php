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
        Schema::table('theses', function (Blueprint $table) {
            $table->enum('complete_status', ['completed', 'not-completed'])->default('not-completed');
            $table->enum('payment_status', ['paid', 'not-paid', 'processing'])->default('not-paid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('theses', function (Blueprint $table) {
            $table->enum('complete_status', ['completed', 'not-completed'])->default('not-completed');
            $table->enum('payment_status', ['paid', 'not-paid', 'processing'])->default('not-paid');
        });
    }
};