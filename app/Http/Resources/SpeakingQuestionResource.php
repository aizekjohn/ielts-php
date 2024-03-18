<?php

namespace App\Http\Resources;

use App\Models\SpeakingQuestion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin SpeakingQuestion */
class SpeakingQuestionResource extends JsonResource
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
            'created_at' => $this->created_at,
        ];
    }
}
