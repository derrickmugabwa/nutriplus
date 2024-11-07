<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    protected $fillable = [
        'name',
        'client_id',
        'user_id',
    ];

    // Relationship to Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relationship to Nutritionist (User)
    public function user()
    {
        return $this->belongsTo(User::class,);
    }

    // Relationship to Meals via MealPlanDays
    public function meals()
    {
        return $this->hasManyThrough(Meal::class, MealPlanMeal::class, 'meal_plan_id', 'id', 'id', 'meal_id');
    }

    // Relationship to MealPlanDays (to organize meals by day)
    // public function days()
    // {
    //     return $this->hasMany(MealPlanDay::class);
    
    // }
    public function mealPlanDays()
{
    return $this->hasMany(MealPlanDay::class);
}
   
}