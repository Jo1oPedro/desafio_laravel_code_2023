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
        Schema::create('pet_user', function (Blueprint $table) {
            $table->id();
            $table->float('value', 8, 2);
            $table->string('work_done');
            $table->foreignId('employee_id')->constrained(
                table: 'employees'
            )->onDelete(null);
            $table->foreignId('pet_id')->constrained(
                table: 'pets'
            )->onDelete(null);
            $table->timestamps();
            $table->dateTime('finished_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_user');
    }
};
