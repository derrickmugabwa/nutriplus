<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlanDay extends Model
{
    protected $fillable = [
        'day',
        'meal_plan_id',
    ];

// public function meals()
// {
//     return $this->hasMany(Meal::class);
// }

public function mealPlan()
{
    return $this->belongsTo(MealPlan::class);
}

public function breakfastMeals()
{
    return $this->belongsToMany(Meal::class, 'meal_plan_day_breakfast_meals', 'meal_plan_day_id', 'meal_id');
}

public function lunchMeals()
{
    return $this->belongsToMany(Meal::class, 'meal_plan_day_lunch_meals', 'meal_plan_day_id', 'meal_id');
}

public function dinnerMeals()
{
    return $this->belongsToMany(Meal::class, 'meal_plan_day_dinner_meals', 'meal_plan_day_id', 'meal_id');
}

public function snackMeals()
{
    return $this->belongsToMany(Meal::class, 'meal_plan_day_snack_meals', 'meal_plan_day_id', 'meal_id');
}
}