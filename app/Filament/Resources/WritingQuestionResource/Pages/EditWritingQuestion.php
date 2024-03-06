<?php

namespace App\Filament\Resources\WritingQuestionResource\Pages;

use App\Filament\Resources\WritingQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWritingQuestion extends EditRecord
{
    protected static string $resource = WritingQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
