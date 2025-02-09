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
class OptionItemsIndexResource extends JsonResource
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
            'option_id' => $this->option_id,
            'item' => $this->item,
            'subtitle' => $this->subtitle,
        ];
    }
}
