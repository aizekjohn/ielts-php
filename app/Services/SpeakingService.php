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
        $query->latest();

        return $query->with('questions')->paginate(
            perPage: $limit,
            page: $page
        );
    }

    public function questions(int $page, int $limit, SpeakingCategory $speakingCategory, ?string $search): LengthAwarePaginator
    {
        $query = $speakingCategory->questions();

        if (!is_null($search)) {
            $query->where('body', 'ilike', "%{$search}%");
        }

        $query->orderBy('order');
        $query->latest();

        return $query->with('answers')->paginate(
            perPage: $limit,
            page: $page
        );
    }
}
