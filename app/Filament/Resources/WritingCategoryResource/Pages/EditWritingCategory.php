<?php

namespace App\Filament\Resources\WritingCategoryResource\Pages;

use App\Filament\Resources\WritingCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWritingCategory extends EditRecord
{
    protected static string $resource = WritingCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
