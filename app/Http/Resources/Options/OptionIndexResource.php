<?php

namespace App\Http\Resources\Options;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $email
 * @property mixed $profile
 * @property mixed $config
 */
class OptionIndexResource extends JsonResource
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
            'unit' => $this->unit,
            'description' => $this->description,
            'guid' => $this->guid,
            'is_active' => $this->is_active,
            'items' => OptionItemsIndexResource::collection($this->items)
        ];
    }
}
