<?php

namespace App\Http\Resources\Plans;

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
class PlanIndexResource extends JsonResource
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
            'access' => $this->access,
            'price' => $this->price,
            'sale' => $this->sale,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'active_users' => $this->users()->where('status', User_Plan::STATUS_ACTIVE)->count(),
            'total_users' => $this->users()->count(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
