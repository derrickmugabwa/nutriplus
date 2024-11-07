<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 
        'email',
        'phone', 
        'phone',
        'address', 
        'gender', 
        'date_of_birth',
        'tags',
        'weight', 
        'height', 
        'body_fat', 
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mealPlans()
    {
        return $this->hasMany(MealPlan::class);
    }

}
