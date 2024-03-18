<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

trait PaginationTrait
{
    public function paginateResponse($paginatedData, $resource)
    {
        /** @var $paginatedData LengthAwarePaginator */
        return [
            'list' => $resource::collection($paginatedData->items()),
            'meta' => [
                'limit' => $paginatedData->perPage(),
                'page' => $paginatedData->currentPage(),
                'total' => $paginatedData->total(),
                'current' => $paginatedData->count(),
                'last_page' => $paginatedData->lastPage(),
            ],
        ];
    }
}
