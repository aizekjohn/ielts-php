<?php

namespace App\Filament\Resources\WritingCategoryResource\Pages;

use App\Filament\Resources\WritingCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListWritingCategory extends ListRecords
{
    protected static string $resource = WritingCategoryResource::class;

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
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'part1';
    }
}
