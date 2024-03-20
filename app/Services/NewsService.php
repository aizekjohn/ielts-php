<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsService
{
    public function list(int $page, int $limit, int $userId): LengthAwarePaginator
    {
        return News::with(['users' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->latest('id')->paginate(
            perPage: $limit,
            page: $page
        );
    }

    public function newsRetrieved(News $news, int $userId): void
    {
        $news->safeIncreaseViews();

        $isRead = $news->users()->wherePivot('user_id', $userId)->exists();

        if (!$isRead) {
            $news->users()->attach($userId);
        }
    }
}
