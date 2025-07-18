<?php

namespace App\Filament\Resources;

use App\Filament\Resources\YearResource\Pages;
use App\Filament\Resources\YearResource\RelationManagers;
use App\Models\Year;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class YearResource extends Resource
{
    protected static ?string $model = Year::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\Toggle::make('is_published')->label('Published?'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\BooleanColumn::make('is_published'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ])->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListYears::route('/'),
            'create' => Pages\CreateYear::route('/create'),
            'edit' => Pages\EditYear::route('/{record}/edit'),
        ];
    }
}
