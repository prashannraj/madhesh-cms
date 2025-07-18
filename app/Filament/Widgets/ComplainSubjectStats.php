<?php

namespace App\Filament\Widgets;

use App\Models\Complain;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ComplainSubjectStats extends BaseWidget
{
    protected static ?string $heading = 'Subject-wise Complaint Count';

    protected function getTableQuery(): Builder
    {
        return Complain::query()
            ->selectRaw('MIN(id) as id, subject_of_complaint, COUNT(*) as total')
            ->groupBy('subject_of_complaint');
    }


    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('subject_of_complaint')
                ->label('Subject of Complaint')
                ->searchable(),

            TextColumn::make('total')
                ->label('Total Complaints')
                ->sortable(),
        ];
    }
}
