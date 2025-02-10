<?php

namespace App\Http\Resources\Questions;

use App\Http\Resources\Colors\ColorShortResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $email
 * @property mixed $profile
 * @property mixed $config
 */
class QuestionIndexResource extends JsonResource
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
            'from_color_id' => $this->from_color_id,
            'to_color_id' => $this->to_color_id,
            'items' => json_decode($this->items, false, 512, JSON_THROW_ON_ERROR),
            'from_color' => new ColorShortResource($this->from_color),
            'to_color' => new ColorShortResource($this->to_color),
            'answers' => QuestionAnswerIndexResource::collection($this->answers),
            'is_active' => $this->is_active,
        ];
    }
}
