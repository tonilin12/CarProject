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
            $table->string('img');
            $table->timestamps();
            
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
