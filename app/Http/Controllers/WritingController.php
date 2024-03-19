<?php

namespace App\Http\Controllers;

use App\Http\Resources\SingleWritingQuestionResource;
use App\Http\Resources\WritingCategoryResource;
use App\Http\Resources\WritingQuestionResource;
use App\Models\WritingCategory;
use App\Models\WritingQuestion;
use App\Services\WritingService;
use App\Traits\ApiResponse;
use App\Traits\PaginationTrait;
use Illuminate\Http\Request;

class WritingController extends Controller
{
    use ApiResponse, PaginationTrait;

    private WritingService $service;

    public function __construct(WritingService $service)
    {
        $this->service = $service;
    }

    public function categories(Request $request)
    {
        $page = $request->query('page', 1);
        $limit = $request->query('limit', config('constants.per_page'));
        $part = $request->query('part', 1);

        $categories = $this->service->categories($page, $limit, $part, $request->query('search'));

        return $this->response(
            data: $this->paginateResponse($categories, WritingCategoryResource::class)
        );
    }

    public function questions(Request $request, WritingCategory $writingCategory)
    {
        $page = $request->query('page', 1);
        $limit = $request->query('limit', config('constants.per_page'));

        $questions = $this->service->questions($page, $limit, $writingCategory, $request->query('search'));

        return $this->response(
            data: $this->paginateResponse($questions, WritingQuestionResource::class)
        );
    }

    public function singleQuestion(WritingQuestion $writingQuestion)
    {
        $writingQuestion->load(['files', 'answers']);

        return $this->response(
            data: SingleWritingQuestionResource::make($writingQuestion)
        );
    }
}
