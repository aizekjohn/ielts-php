<?php

namespace App\Http\Resources;

use App\Models\WritingQuestion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin WritingQuestion */
class WritingQuestionResource extends JsonResource
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
            'answers_count' => $this->answers_count,
            'order' => $this->order,
            'files' => FileResource::collection($this->whenLoaded('files')),
            'created_at' => $this->created_at,
        ];
    }
}
