<?php

namespace App\Filament\Resources\ComplainResource\Pages;

use App\Filament\Resources\ComplainResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms;
use Illuminate\Support\Str;
use Filament\Pages\Actions\Action;

class CreateComplain extends CreateRecord
{
    protected static string $resource = ComplainResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('⬅ Back to Dashboard')
                ->url(ComplainResource::getUrl())
                ->color('gray'),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // यहाँ submission_number auto-increment generate गर्ने logic राख्न सकिन्छ
        $maxSubmissionNumber = \App\Models\Complain::max('submission_number') ?? 0;
        $data['submission_number'] = $maxSubmissionNumber + 1;

        // terms_accepted मा checkbox हुन्छ, यो default true हुनु पर्छ जब form submit हुन्छ
        $data['terms_accepted'] = true;

        // subject_of_complaint array छ भने JSON मा convert गर्नुहोस्
        if (isset($data['subject_of_complaint']) && is_array($data['subject_of_complaint'])) {
            $data['subject_of_complaint'] = json_encode($data['subject_of_complaint']);
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
