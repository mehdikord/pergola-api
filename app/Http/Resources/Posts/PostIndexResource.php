<?php

namespace App\Http\Resources\Posts;

use App\Models\User_Plan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $email
 * @property mixed $profile
 * @property mixed $config
 */
class PostIndexResource extends JsonResource
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
            'post_category_id' => $this->post_category_id,
            'slug' => $this->slug,
            'description' => $this->description,
            'image' => $this->image,
            'is_active' => $this->is_active,
            'views' => $this->views,
            'category' => new PostCategoryIndexResource($this->whenLoaded('category')),
            'files' => $this->files,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
