<?php

namespace App\Filament\Resources\NoticeResource\Pages;

use App\Filament\Resources\NoticeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Actions\Action;

class CreateNotice extends CreateRecord
{
    protected static string $resource = NoticeResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('⬅ Back to List')
                ->url(NoticeResource::getUrl())
                ->color('gray'),
        ];
    }
}
