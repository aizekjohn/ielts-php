<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsResource;
use App\Http\Resources\SingleNewsResource;
use App\Models\News;
use App\Services\NewsService;
use App\Traits\ApiResponse;
use App\Traits\PaginationTrait;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use ApiResponse, PaginationTrait;

    private NewsService $service;

    public function __construct(NewsService $service)
    {
        $this->service = $service;
    }

    public function list(Request $request)
    {
        $page = $request->query('page', 1);
        $limit = $request->query('limit', config('constants.per_page'));

        $news = $this->service->list($page, $limit, auth()->id());

        return $this->response(
            data: $this->paginateResponse($news, NewsResource::class)
        );
    }

    public function single(News $news)
    {
        $this->service->newsRetrieved($news, auth()->id());

        return $this->response(
            data: SingleNewsResource::make($news)
        );
    }

    public function unread()
    {
        $unreadCount = $this->service->unreadCount(auth()->id());

        return $this->response(
            data: [
                'unread_count' => $unreadCount,
            ]
        );
    }

    public function markAllRead()
    {
        $this->service->markAllAsRead(auth()->user());

        return $this->response(
            message: 'All news are marked as "read"'
        );
    }
}
