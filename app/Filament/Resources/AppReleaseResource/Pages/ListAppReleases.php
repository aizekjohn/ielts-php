<?php

namespace App\Filament\Resources\AppReleaseResource\Pages;

use App\Enums\DevicePlatform;
use App\Filament\Resources\AppReleaseResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListAppReleases extends ListRecords
{
    protected static string $resource = AppReleaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'android' => Tab::make('Android')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('platform', DevicePlatform::ANDROID)),
            'ios' => Tab::make('IOS')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('platform', DevicePlatform::IOS)),
        ];
    }

    public function getDefaultActiveTab(): string | int | null
    {
        return 'android';
    }
}
