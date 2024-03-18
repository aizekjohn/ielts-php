<?php

namespace App\Services;

use App\Models\SpeakingCategory;
use Illuminate\Pagination\LengthAwarePaginator;

class SpeakingService
{
    public function categories(int $page, int $limit, int $part, ?string $search): LengthAwarePaginator
    {
        $query = SpeakingCategory::query();

        $query->where('part', $part);

        if (!is_null($search)) {
            $query->where('name', 'ilike', "%{$search}%");
        }

        $query->orderBy('order');

        return $query->paginate(
            perPage: $limit,
            page: $page
        );
    }
}
