<?php

namespace App\Filament\Resources\SliderResource\Pages;

use App\Filament\Resources\SliderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Actions\Action;

class CreateSlider extends CreateRecord
{
    protected static string $resource = SliderResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('⬅ Back to List')
                ->url(SliderResource::getUrl())
                ->color('gray'),
        ];
    }
}
