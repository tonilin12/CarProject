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
        Schema::create('cars', function (Blueprint $table) {
            $table->id(); // Az 'id' mező elsődleges kulcs
            $table->string('reg_num')->unique(); // 'reg_num' mező, egyedi
            $table->string('brand'); // 'brand' mező
            $table->date('booking_startdate')->nullable(); // 'booking_startdate' mező, alapértelmezett érték: null
            $table->date('booking_deadline')->nullable(); // 'booking_deadline' mező, alapértelmezett érték: null
            $table->unsignedBigInteger('user_id'); // 'user_id' mező, kapcsolódik az 'users' táblához
            $table->timestamps(); // 'created_at' és 'updated_at' mezők automatikusan hozzáadódnak

            // Külső kulcs beállítása
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Külső kulcs eltávolítása a tábla törlése előtt
            $table->dropForeign(['user_id']);
        });
        
        Schema::dropIfExists('cars');
    }
};
