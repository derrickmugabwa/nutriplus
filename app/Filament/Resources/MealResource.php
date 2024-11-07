<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MealResource\Pages;
use App\Filament\Resources\MealResource\RelationManagers;
use App\Models\Meal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use Filament\Facades\Filament;


class MealResource extends Resource
{
    protected static ?string $model = Meal::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            TextInput::make('name')
                ->label('Meal Name')
                ->required(),
            TextInput::make('total_calories')
                ->label('Calories')
                ->numeric(),
            TextInput::make('total_protein')
                ->label('Protein')
                ->numeric(),
            TextInput::make('total_carbs')
                ->label('Carbs')
                ->numeric(),
            TextInput::make('total_fats')
                ->label('Fat')
                ->numeric(),
            Textarea::make('description')
                ->label('Description')
                ->rows(3),

            Hidden::make('created_by')
               ->default(auth()->id())
        ]);
}

    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('total_calories')->searchable(),
                Tables\Columns\TextColumn::make('total_protein')->searchable(),
                Tables\Columns\TextColumn::make('total_carbs')->searchable(),
                Tables\Columns\TextColumn::make('total_fats')->searchable(),
                Tables\Columns\TextColumn::make('created_by')->searchable(),
                
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
            'index' => Pages\ListMeals::route('/'),
            'create' => Pages\CreateMeal::route('/create'),
            'edit' => Pages\EditMeal::route('/{record}/edit'),
        ];
    }
}
