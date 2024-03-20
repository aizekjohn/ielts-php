<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Pagination\LengthAwarePaginator;

class NotificationService
{
    public function list(int $page, int $limit, int $userId): LengthAwarePaginator
    {
        return Notification::where('user_id', $userId)
            ->orderBy('is_read')
            ->orderBy('id', 'desc')
            ->paginate(
                perPage: $limit,
                page: $page
            );
    }

    public function hasUnread(int $userId): bool
    {
        return Notification::where('user_id', $userId)->where('is_read', false)->exists();
    }

    public function markAsRead(?array $ids): void
    {
        Notification::whereIn('id', $ids)
            ->where('is_read', false)
            ->update([
            'is_read' => true,
        ]);
    }
}
