<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDayNumberToDayInMealPlanDaysTable extends Migration
{
    public function up()
    {
        Schema::table('meal_plan_days', function (Blueprint $table) {
            $table->dropColumn('day_number');
            $table->string('day')->after('meal_plan_id');
        });
    }

    public function down()
    {
        Schema::table('meal_plan_days', function (Blueprint $table) {
            $table->dropColumn('day');
            $table->integer('day_number')->after('meal_plan_id');
        });
    }
}