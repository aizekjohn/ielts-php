<?php

namespace App\Http\Resources;

use App\Models\WritingQuestion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin WritingQuestion */
class SingleWritingQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'answers_count' => $this->answers->count(),
            'order' => $this->order,
            'files' => FileResource::collection($this->whenLoaded('files')),
            'answers' => $this->whenLoaded('answers', $this->normalizeModelAnswers($this->answers)),
            'created_at' => $this->created_at,
        ];
    }

    private function normalizeModelAnswers(?Collection $answers): array
    {
        return $answers->sortBy('band')->groupBy('band')->map(function ($group) {
            return [
                'band' => $group->first()->band,
                'answers' => $group->sortBy('order')->select(['title', 'body'])->toArray(),
            ];
        })->values()->toArray();
    }
}
