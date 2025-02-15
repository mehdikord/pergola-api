<?php

namespace App\Http\Resources\Users;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $email
 * @property mixed $profile
 * @property mixed $config
 */
class UserPlanActiveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $days = null;
        if ($this->star_at && $this->end_at){
            $start = Carbon::make($this->start_at);
            $days = $start->diffInDays($this->end_at);
        }
        return [
            'id' => $this->id,
            'title' => $this->id,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'days' => $days
        ];
    }
}
