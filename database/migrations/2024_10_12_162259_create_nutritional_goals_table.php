<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionalGoalsTable extends Migration
{
    public function up()
    {
        Schema::create('nutritional_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->decimal('daily_calories', 8, 2);
            $table->decimal('daily_protein', 8, 2);
            $table->decimal('daily_carbs', 8, 2);
            $table->decimal('daily_fats', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nutritional_goals');
    }
}

