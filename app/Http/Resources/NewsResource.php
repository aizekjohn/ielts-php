<?php

namespace App\Http\Resources;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/** @mixin News */
class NewsResource extends JsonResource
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
            'title' => $this->title,
            'image' => Storage::url($this->image),
            'views' => $this->views,
            'is_read' => $this->users->count() > 0,
            'created_at' => $this->created_at,
        ];
    }
}
