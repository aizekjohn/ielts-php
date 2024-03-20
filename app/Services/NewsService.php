<?php

namespace App\Services;

use App\Models\News;
use App\Models\User;
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

    public function unreadCount(int $userId): int
    {
        return News::whereDoesntHave('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();
    }

    public function markAllAsRead(User $user): void
    {
        $unreadNews = News::whereDoesntHave('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->pluck('id');

        $user->news()->attach($unreadNews);
    }
}
