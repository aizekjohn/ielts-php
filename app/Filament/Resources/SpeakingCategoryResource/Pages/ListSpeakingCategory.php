<?php

namespace App\Filament\Resources\SpeakingCategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SpeakingCategoryResource;

class ListSpeakingCategory extends ListRecords
{
    protected static string $resource = SpeakingCategoryResource::class;

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
                ->modifyQueryUsing(fn (Builder $query) => $query->where('part', 1)),
            'part2' => Tab::make('PART 2')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('part', 2)),
            'part3' => Tab::make('PART 3')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('part', 3)),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'part1';
    }
}
