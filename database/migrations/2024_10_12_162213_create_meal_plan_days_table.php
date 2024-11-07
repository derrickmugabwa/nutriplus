<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealPlanDaysTable extends Migration
{
    public function up()
    {
        Schema::create('meal_plan_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_plan_id')->constrained('meal_plans')->onDelete('cascade');
            $table->integer('day_number');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meal_plan_days');
    }
}
