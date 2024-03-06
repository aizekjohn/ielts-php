<?php

namespace App\Filament\Resources\WritingQuestionResource\Pages;

use App\Filament\Resources\WritingQuestionResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListWritingQuestions extends ListRecords
{
    protected static string $resource = WritingQuestionResource::class;

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
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'part1';
    }
}
