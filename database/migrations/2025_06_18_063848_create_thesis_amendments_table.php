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

        Schema::create('thesis_amendments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thesis_id')->constrained()->onDelete('cascade');

            $table->enum('type', ['initial', 'amendment'])->default('amendment');
            $table->string('file_path'); // Student’s uploaded file
            $table->enum('status', ['submitted', 'under-review', 'changes-requested', 'accepted'])->default('submitted');

            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('reviewed_at')->nullable();

            $table->foreignId('reviewed_by')->nullable()->constrained('supervisors')->onDelete('set null');
            $table->text('supervisor_feedback')->nullable();
            $table->string('supervisor_file_path')->nullable(); // Optional review file

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
        Schema::dropIfExists('thesis_amendments');
    }
};
