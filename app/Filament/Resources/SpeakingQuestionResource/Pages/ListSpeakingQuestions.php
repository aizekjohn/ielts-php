<?php

namespace App\Filament\Resources\SpeakingQuestionResource\Pages;

use App\Filament\Resources\SpeakingQuestionResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListSpeakingQuestions extends ListRecords
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

    public function getDefaultActiveTab(): string | int | null
    {
        return 'part1';
    }
}
