<?php

namespace App\Filament\Resources\MealPlanResource\Pages;

use App\Filament\Resources\MealPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMealPlan extends EditRecord
{
    protected static string $resource = MealPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
