<?php

namespace App\Services;

use App\Models\WritingCategory;
use App\Models\WritingQuestion;
use Illuminate\Pagination\LengthAwarePaginator;

class WritingService
{
    public function categories(int $page, int $limit, int $part, ?string $search): LengthAwarePaginator
    {
        $query = WritingCategory::query();

        $query->where('part', $part);

        if (!is_null($search)) {
            $query->where('name', 'ilike', "%{$search}%");
        }

        $query->orderBy('order');
        $query->latest();

        return $query->withCount('questions')->paginate(
            perPage: $limit,
            page: $page
        );
    }

    public function questions(int $page, int $limit, WritingCategory $writingCategory, ?string $search): LengthAwarePaginator
    {
        $query = $writingCategory->questions();

        if (!is_null($search)) {
            $query->where('body', 'ilike', "%{$search}%");
        }

        $query->orderBy('order');
        $query->latest();

        return $query->withCount('answers')->paginate(
            perPage: $limit,
            page: $page
        );
    }
}
