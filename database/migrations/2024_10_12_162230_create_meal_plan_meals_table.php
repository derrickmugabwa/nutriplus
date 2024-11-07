<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealPlanMealsTable extends Migration
{
    public function up()
    {
        Schema::create('meal_plan_meals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_plan_day_id')->constrained('meal_plan_days')->onDelete('cascade');
            $table->foreignId('meal_id')->constrained('meals')->onDelete('cascade');
            $table->string('time_of_day'); // Breakfast, Lunch, Dinner
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meal_plan_meals');
    }
}
