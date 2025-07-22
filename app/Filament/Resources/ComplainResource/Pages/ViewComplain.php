<?php

namespace App\Filament\Resources\ComplainResource\Pages;

use App\Filament\Resources\ComplainResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;
use Filament\Actions\Action;

class ViewComplain extends ViewRecord
{
    protected static string $resource = ComplainResource::class;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('submission_number')->disabled(),
            Forms\Components\TextInput::make('name')->disabled(),
            Forms\Components\Textarea::make('subject_of_complaint')->disabled(),
            Forms\Components\Textarea::make('additional_info')->disabled(),
            Forms\Components\FileUpload::make('uploaded_file')
                ->disabled()
                ->previewable()
                ->directory('complaints'),

            Forms\Components\Select::make('status')
                ->options([
                    'Processing' => 'Processing',
                    'Holding' => 'Holding',
                    'Finished' => 'Finished',
                ])
                ->label('Complaint Status')
                ->required(),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Print')
                ->label('Print')
                ->icon('heroicon-o-printer')
                ->url(fn () => route('complaints.print', $this->record->id))
                ->openUrlInNewTab(),

            // Action::make('Download PDF')
            // ->label('Download PDF')
            // ->icon('heroicon-o-arrow-down-tray')
            // ->url(fn () => route('complain.download', $this->record->id)),
        ];
    }
}
