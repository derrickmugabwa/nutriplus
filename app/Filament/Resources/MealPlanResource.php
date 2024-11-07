<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MealPlanResource\Pages;
use App\Filament\Resources\MealPlanResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\MealPlan;
use App\Models\Client;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use App\Models\Meal;
use Filament\Forms\Components\Hidden;


class MealPlanResource extends Resource
{
    protected static ?string $model = MealPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['user_id'] = auth()->id();
    return $data;
}

    public static function form(Form $form): Form
    {
        return $form
        ->schema([

            Section::make('')
                ->schema([

            Hidden::make('user_id')
                ->default(fn () => auth()->id())
                ->required(),
            // Select Client
            Select::make('client_id')
                ->label('Client')
                ->relationship('client', 'name') // Adjust this according to the actual client name column
                ->required()
                ->searchable(),

            // Name of the Meal Plan
            TextInput::make('name')
                ->label('Meal Plan Name')
                ->required(),

                ])
                ->columns(2),


            // Section for Each Day of the Week
            Section::make('Meal Plan for the Week')
                ->schema([

                    // Repeater for days of the week
                    Repeater::make('mealPlanDays')
                        ->relationship('mealPlanDays')  // Assuming this relationship exists in MealPlan
                        ->schema([

                            // Dropdown for the day of the week
                            Select::make('day')
                                ->label('Day')
                                ->options([
                                    'Monday' => 'Monday',
                                    'Tuesday' => 'Tuesday',
                                    'Wednesday' => 'Wednesday',
                                    'Thursday' => 'Thursday',
                                    'Friday' => 'Friday',
                                    'Saturday' => 'Saturday',
                                    'Sunday' => 'Sunday',
                                ])
                                ->required(),

                            // Use Grid to display meal types on the same line
                            Grid::make(4) // 4 columns for Breakfast, Lunch, Dinner, and Snack
                                ->schema([
                                    
                                    // Breakfast Meals (Repeater for multiple meals)
                                    Repeater::make('breakfastMeals')
                                    ->relationship('breakfastMeals')
                                    ->schema([
                                        Select::make('id')
                                            ->label('Meal')
                                            ->options(fn () => Meal::pluck('name', 'id'))
                                            ->required()
                                            ->searchable(),
                                        ])
                                        ->minItems(1) // At least 1 meal is required
                                        ->label('Breakfast'),

                                    // Lunch Meals (Repeater for multiple meals)
                                    Repeater::make('lunchMeals')
                                      ->relationship('lunchMeals')
                                      ->schema([
                                        Select::make('id')
                                                ->label('Meal')
                                                ->options(fn () => Meal::pluck('name', 'id'))
                                                ->required()
                                                ->searchable(),
                                        ])
                                        ->minItems(1) // At least 1 meal is required
                                        ->label('Lunch'),

                                    // Dinner Meals (Repeater for multiple meals)
                                    Repeater::make('dinnerMeals')
                                    ->relationship('dinnerMeals')
                                    ->schema([
                                        Select::make('id')
                                            ->label('Meal')
                                            ->options(fn () => Meal::pluck('name', 'id'))
                                            ->required()
                                            ->searchable(),
                                        ])
                                        ->minItems(1) // At least 1 meal is required
                                        ->label('Dinner'),

                                    // Snack Meals (Repeater for multiple meals)
                                    Repeater::make('snackMeals')
                                    ->relationship('snackMeals')
                                    ->schema([
                                        Select::make('id')
                                            ->label('Meal')
                                            ->options(fn () => Meal::pluck('name', 'id'))
                                            ->required()
                                            ->searchable(),
                                        ])
                                        ->minItems(1) // At least 1 meal is required
                                        ->label('Snack'),

                                    // Hidden::make('user_id')
                                    // ->default(auth()->id())
                                ]),

                        ])
                        ->minItems(7)  // Ensures there are always 7 days
                        ->maxItems(7)  // Ensures there are only 7 days
                        ->defaultItems(7),  // Pre-fill the days
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('client.name')
                ->label('Client'),
            Tables\Columns\TextColumn::make('name')
                ->label('Meal Plan Name'),
            Tables\Columns\TextColumn::make('mealPlanDays.day')
                ->label('Days'),
            Tables\Columns\TextColumn::make('mealPlanDays.breakfastMeals.name')
                ->label('Breakfast Meals'),
            Tables\Columns\TextColumn::make('mealPlanDays.lunchMeals.name')
                ->label('Lunch Meals'),
            Tables\Columns\TextColumn::make('mealPlanDays.dinnerMeals.name')
                ->label('Dinner Meals'),
            Tables\Columns\TextColumn::make('mealPlanDays.snackMeals.name')
                ->label('Snack Meals'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMealPlans::route('/'),
            'create' => Pages\CreateMealPlan::route('/create'),
            'edit' => Pages\EditMealPlan::route('/{record}/edit'),
        ];
    }
}
