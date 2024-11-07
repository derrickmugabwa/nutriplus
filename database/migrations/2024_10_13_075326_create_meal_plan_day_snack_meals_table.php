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
    {Schema::create('meal_plan_day_snack_meals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('meal_plan_day_id')->constrained()->onDelete('cascade');
        $table->foreignId('meal_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });

}
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_plan_day_snack_meals');
    }
};
