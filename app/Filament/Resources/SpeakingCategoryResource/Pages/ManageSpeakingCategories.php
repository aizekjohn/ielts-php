<?php

namespace App\Filament\Resources\SpeakingCategoryResource\Pages;

use App\Filament\Resources\SpeakingCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSpeakingCategories extends ManageRecords
{
    protected static string $resource = SpeakingCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
