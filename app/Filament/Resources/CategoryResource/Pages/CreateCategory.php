<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Actions\Action;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('⬅ Back to List')
                ->url(CategoryResource::getUrl())
                ->color('gray'),
        ];
    }

}
