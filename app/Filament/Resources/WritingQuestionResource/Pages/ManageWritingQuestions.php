<?php

namespace App\Filament\Resources\WritingQuestionResource\Pages;

use App\Filament\Resources\WritingQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageWritingQuestions extends ManageRecords
{
    protected static string $resource = WritingQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
