<?php

namespace App\Filament\Resources\SpeakingQuestionResource\Pages;

use Filament\Actions;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ManageRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\Resources\SpeakingQuestionResource;

class ManageSpeakingQuestions extends ManageRecords
{
    protected static string $resource = SpeakingQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'part1' => Tab::make('PART 1')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('category', function ($category) {
                    $category->where('part', 1);
                })),
            'part2' => Tab::make('PART 2')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('category', function ($category) {
                    $category->where('part', 2);
                })),
            'part3' => Tab::make('PART 3')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('category', function ($category) {
                    $category->where('part', 3);
                })),
        ];
    }
}
