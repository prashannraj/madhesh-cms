<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplainResource\Pages;
use App\Models\Complain;
use App\Models\Year;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;

class ComplainResource extends Resource
{
    protected static ?string $model = Complain::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';
    protected static ?string $navigationGroup = 'Complain Management';
    protected static ?string $navigationLabel = 'Complains';
    protected static ?string $label = 'Complaint';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Complain Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required()->disabled(),
                        Forms\Components\Select::make('year_id')
                            ->label('Year')
                            ->options(
                                Year::where('is_published', true)
                                    ->pluck('title', 'id')
                                    ->toArray()
                            )
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('contact_number')->disabled(),
                        Forms\Components\TextInput::make('email')->disabled(),
                        Forms\Components\Textarea::make('subject_of_complaint')->label('Subjects')->disabled(),
                        Forms\Components\Textarea::make('additional_info')->disabled(),
                        Forms\Components\FileUpload::make('uploaded_file')
                            ->label('Attached File')
                            ->disabled()
                            ->downloadable()
                            ->previewable()
                            ->directory('complains')
                            ->visibility('private'),
                        Forms\Components\Select::make('status')
                            ->options([
                                'Processing' => 'Processing',
                                'Holding' => 'Holding',
                                'Finished' => 'Finished',
                            ])
                            ->required()
                            ->label('Complaint Status'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('year.title')->label('Year'),
                BadgeColumn::make('name_type')->colors(['individual' => 'primary', 'group' => 'success']),
                BadgeColumn::make('gender')->colors([
                    'male' => 'info',
                    'female' => 'pink',
                    'third_gender' => 'gray',
                    'others' => 'gray',
                ]),
                BadgeColumn::make('age_group')->label('Age Group'),
                TextColumn::make('contact_number'),
                TextColumn::make('email')->toggleable(),
                BadgeColumn::make('complaint_type')->label('Type')->colors([
                    'corruption' => 'danger',
                    'illegal_property' => 'warning',
                ]),
                TextColumn::make('corruption_domain')->label('Domain'),
                TextColumn::make('against_person_or_institution')->label('Against'),
                IconColumn::make('terms_accepted')->boolean()->label('Accepted Terms'),
                TextColumn::make('created_at')->label('Date')->dateTime(),
                TextColumn::make('submission_number')->label('Submission No.')->sortable(),
                BadgeColumn::make('status')->colors([
                    'Processing' => 'info',
                    'Holding' => 'warning',
                    'Finished' => 'success',
                ]),
            ])
            ->filters([
                SelectFilter::make('year_id')
                    ->label('Year')
                    ->options(
                        Year::where('is_published', true)
                            ->pluck('title', 'id')
                            ->toArray()
                    ),
                SelectFilter::make('complaint_type')->options([
                    'corruption' => 'Corruption',
                    'illegal_property' => 'Illegal Property',
                ]),
                SelectFilter::make('gender')->options([
                    'male' => 'Male',
                    'female' => 'Female',
                    'third_gender' => 'Third Gender',
                    'others' => 'Others',
                ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComplains::route('/'),
            'create' => Pages\CreateComplain::route('/create'),
            'view' => Pages\ViewComplain::route('/{record}'),
            'edit' => Pages\EditComplain::route('/{record}/edit'),
        ];
    }

    public static function getRecordTitle($record): string
    {
        return 'Complain #' . ($record->submission_number ?? $record->id);
    }
}
