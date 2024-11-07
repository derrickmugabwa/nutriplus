<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'name',
        'description',
        'total_calories',
        'total_protein',
        'total_carbs',
        'total_fats',
        'created_by'
    ];
}
