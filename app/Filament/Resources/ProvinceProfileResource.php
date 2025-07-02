<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProvinceProfileResource\Pages;
use App\Filament\Resources\ProvinceProfileResource\RelationManagers;
use App\Models\ProvinceProfile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProvinceProfileResource extends Resource
{
    protected static ?string $model = ProvinceProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('province_id')
                    ->label('Province')
                    ->relationship('province', 'name') // relasi dengan model Province
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('year')
                    ->required()
                    ->numeric()
                    ->default(2024),
                Forms\Components\TextInput::make('population')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('gdp')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('num_elementary')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('num_middle')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('num_high')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('num_university')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('province.name')
                    ->label('Province'),
                Tables\Columns\TextColumn::make('year')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('population')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gdp')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('num_elementary')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('num_middle')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('num_high')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('num_university')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListProvinceProfiles::route('/'),
            'create' => Pages\CreateProvinceProfile::route('/create'),
            'edit' => Pages\EditProvinceProfile::route('/{record}/edit'),
        ];
    }
}
