<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('overtimes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->string('job');
            $table->date('worked_at');
            $table->integer('hours_in_mins');
            $table->decimal('rate', 5, 2);
            $table->decimal('total', 5, 2);
            $table->string('division_name');
            $table->string('field_name');
            $table->string('category', 10);
            $table->string('work_type', 10);
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtimes');
    }
};
