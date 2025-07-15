<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DownloadResource\Pages;
use App\Filament\Resources\DownloadResource\RelationManagers;
use App\Models\Download;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;

class DownloadResource extends Resource
{
    protected static ?string $model = Download::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\Select::make('type')
                    ->options([
                        'form' => 'Form',
                        'manual' => 'Manual',
                        'guide' => 'Guide',
                    ])
                    ->default('form'),
                Forms\Components\Select::make('category_id')
                                ->label('Category')
                                ->relationship('category', 'title')
                                ->searchable()
                                ->required(),
                Forms\Components\FileUpload::make('file')
                    ->label('Upload File')
                    ->acceptedFileTypes(['application/pdf', 'application/zip', 'application/msword'])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('type')->badge(),
                Tables\Columns\TextColumn::make('file')->label('File'),
                Tables\Columns\TextColumn::make('category.title')->label('Category'),
                Tables\Columns\TextColumn::make('created_at')->label('Uploaded')->since(),
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
            'index' => Pages\ListDownloads::route('/'),
            'create' => Pages\CreateDownload::route('/create'),
            'edit' => Pages\EditDownload::route('/{record}/edit'),
        ];
    }
}
