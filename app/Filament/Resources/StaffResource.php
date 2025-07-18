<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaffResource\Pages;
use App\Filament\Resources\StaffResource\RelationManagers;
use App\Models\Staff;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StaffResource extends Resource
{
    protected static ?string $model = Staff::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
       return $form->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('designation')->required(),
                Forms\Components\FileUpload::make('photo')->image()->directory('staff')->avatar(),
                Forms\Components\Textarea::make('bio')->rows(5),
                Forms\Components\TextInput::make('priority')->numeric()->default(0),
                Forms\Components\Toggle::make('is_active')->default(true)->label('Show on site?'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
                Tables\Columns\ImageColumn::make('photo')->label('Photo')->circular(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('designation')->searchable(),
                Tables\Columns\BooleanColumn::make('is_active')->label('Visible'),
                Tables\Columns\TextColumn::make('priority')->sortable(),
            ])->defaultSort('priority')
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
            'index' => Pages\ListStaff::route('/'),
            'create' => Pages\CreateStaff::route('/create'),
            'edit' => Pages\EditStaff::route('/{record}/edit'),
        ];
    }
}
