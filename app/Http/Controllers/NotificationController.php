<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Services\NotificationService;
use App\Traits\ApiResponse;
use App\Traits\PaginationTrait;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use ApiResponse, PaginationTrait;

    private NotificationService $service;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    public function list(Request $request)
    {
        $page = $request->query('page', 1);
        $limit = $request->query('limit', config('constants.per_page'));

        $notifications = $this->service->list($page, $limit, auth()->id());

        // mark notifications on the current page as read
        $this->service->markAsRead($notifications->pluck('id')->toArray());

        return $this->response(
            data: $this->paginateResponse($notifications, NotificationResource::class)
        );
    }

    public function unread()
    {
        return $this->response(
            data: [
                'has_unread' => $this->service->hasUnread(auth()->id()),
            ]
        );
    }
}
