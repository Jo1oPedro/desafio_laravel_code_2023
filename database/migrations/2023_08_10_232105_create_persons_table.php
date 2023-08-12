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
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->date('birthdate');
            $table->enum('person_specialization', ['users', 'owners']);
            $table->foreignId('address_id')->constrained(
                table: 'addresses'
            )->onDelete(null);
            $table->foreignId('phone_number_id')->constrained(
                table: 'phone_numbers'
            )->onDelete(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
