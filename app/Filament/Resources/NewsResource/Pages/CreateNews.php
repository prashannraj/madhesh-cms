<?php

namespace App\Filament\Resources\NewsResource\Pages;

use App\Filament\Resources\NewsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Actions\Action;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('⬅ Back to List')
                ->url(NewsResource::getUrl())
                ->color('gray'),
        ];
    }
}
