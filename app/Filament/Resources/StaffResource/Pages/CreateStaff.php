<?php

namespace App\Filament\Resources\StaffResource\Pages;

use App\Filament\Resources\StaffResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Actions\Action;

class CreateStaff extends CreateRecord
{
    protected static string $resource = StaffResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('⬅ Back to List')
                ->url(StaffResource::getUrl())
                ->color('gray'),
        ];
    }
}
