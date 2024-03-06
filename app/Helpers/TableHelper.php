<?php

namespace App\Helpers;

use Carbon\Carbon;
use Exception;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Indicator;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables;

class TableHelper
{
    /**
     * @throws Exception
     */
    public static function filterCreatedAt(): Tables\Filters\BaseFilter
    {
        return Tables\Filters\Filter::make('created_at')
            ->form([
                DatePicker::make('from'),
                DatePicker::make('until')->default(now()),
            ])
            ->query(function (Builder $query, array $data): Builder {
                return $query
                    ->when(
                        $data['from'],
                        fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                    )
                    ->when(
                        $data['until'],
                        fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                    );
            })
            ->indicateUsing(function (array $data): array {
                $indicators = [];

                if ($data['from'] ?? null) {
                    $indicators[] = Indicator::make('Created from ' . Carbon::parse($data['from'])->toFormattedDateString())
                        ->removeField('from');
                }

                if ($data['until'] && $data['until'] != now()->format('Y-m-d') ?? null) {
                    $indicators[] = Indicator::make('Created until ' . Carbon::parse($data['until'])->toFormattedDateString())
                        ->removeField('until');
                }

                return $indicators;
            });
    }
}
