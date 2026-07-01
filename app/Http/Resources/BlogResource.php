<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         return [
            'id' => (string) $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'tags' => $this->meta_keywords
    ? array_map('trim', explode(',', $this->meta_keywords))
    : [],
            'description'=>$this->description,
            'publishedAt' => optional($this->published_at)->toISOString(),
            'image' => $this->hero_image ?? null,
        ];
    }
}
