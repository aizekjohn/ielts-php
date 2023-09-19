<?php

namespace App\Filament\Resources\SpeakingQuestionResource\Pages;

use App\Filament\Resources\SpeakingQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSpeakingQuestions extends ManageRecords
{
    protected static string $resource = SpeakingQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
