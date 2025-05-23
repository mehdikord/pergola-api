<?php

namespace App\Http\Resources\Colors;

use App\Http\Resources\Color_Groups\ColorGroupShortResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $email
 * @property mixed $profile
 * @property mixed $config
 */
class ColorIndexResource extends JsonResource
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
            'image' => $this->image,
            'color' => $this->color,
            'current_choices' => $this->current_choices,
            'convert_choices' => $this->convert_choices,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'group' => new ColorGroupShortResource($this->group)
        ];
    }
}
