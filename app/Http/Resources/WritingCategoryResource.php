<?php

namespace App\Http\Resources;

use App\Models\WritingCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/** @mixin WritingCategory */
class WritingCategoryResource extends JsonResource
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
            'name' => $this->name,
            'image' => Storage::url($this->image),
            'questions_count' => $this->questions_count,
            'part' => $this->part,
            'order' => $this->order,
            'created_at' => $this->created_at,
        ];
    }
}
