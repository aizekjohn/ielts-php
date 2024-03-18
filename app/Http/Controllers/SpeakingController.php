<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpeakingCategoryResource;
use App\Http\Resources\SpeakingQuestionResource;
use App\Models\SpeakingCategory;
use App\Models\SpeakingQuestion;
use App\Services\SpeakingService;
use App\Traits\ApiResponse;
use App\Traits\PaginationTrait;
use Illuminate\Http\Request;

class SpeakingController extends Controller
{
    use ApiResponse, PaginationTrait;

    private SpeakingService $service;

    public function __construct(SpeakingService $service)
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
            data: $this->paginateResponse($categories, SpeakingCategoryResource::class)
        );
    }

    public function questions(Request $request, SpeakingCategory $speakingCategory)
    {
        $page = $request->query('page', 1);
        $limit = $request->query('limit', config('constants.per_page'));

        $questions = $this->service->questions($page, $limit, $speakingCategory, $request->query('search'));

        return $this->response(
            data: $this->paginateResponse($questions, SpeakingQuestionResource::class)
        );
    }

    public function singleQuestion(SpeakingQuestion $speakingQuestion)
    {
        $modalAnswers = $this->service->modalAnswers($speakingQuestion);

        return $this->response(
            data: [
                'question' => SpeakingQuestionResource::make($speakingQuestion),
                'answers' => $modalAnswers,
            ]
        );
    }
}
