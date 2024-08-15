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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // User's name
            $table->string('email')->unique(); // User's email, unique
            $table->timestamp('email_verified_at')->nullable(); // Email verification timestamp
            $table->string('password'); // User's password
            $table->boolean('admin')->default(false); // User admin status, default to false

            $table->string('phone_number')->nullable(); // User's phone number, nullable
            $table->text('address')->nullable(); // User's address, nullable

            
            $table->rememberToken(); // Token for remembering the user
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
