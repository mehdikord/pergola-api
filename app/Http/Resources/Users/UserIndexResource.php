<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $email
 * @property mixed $profile
 * @property mixed $config
 */
class UserIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $plan_status=0;
        if (count($this->plans))
        {
            $plan_status=1;
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'age' => $this->age,
            'image' => $this->image,
            'is_active' => $this->is_active,
            'plan_status' => $plan_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
