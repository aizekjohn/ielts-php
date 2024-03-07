<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

trait PaginationTrait
{
    public function paginateResponse($paginatedData, $resource)
    {
        /** @var $paginatedData LengthAwarePaginator */
        return $resource::collection($paginatedData->items())
            ->additional([
                'meta' => [
                    'limit' => $paginatedData->perPage(),
                    'page' => $paginatedData->currentPage(),
                    'total' => $paginatedData->total(),
                    'current' => $paginatedData->count(),
                    'lastPage' => $paginatedData->lastPage(),
                ],
            ]);
    }
}
