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
class PostCategoryIndexResource extends JsonResource
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
            'color' => $this->color,
            'posts_count' => $this->posts_count,
            'description' => $this->description
        ];
    }
}
