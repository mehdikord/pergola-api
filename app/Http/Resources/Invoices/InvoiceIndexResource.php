<?php

namespace App\Http\Resources\Invoices;

use App\Http\Resources\Users\UserIndexResource;
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
class InvoiceIndexResource extends JsonResource
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
            'user_id' => $this->user_id,
            'user' => new UserIndexResource($this->user),
            'amount' => $this->amount,
            'method' => $this->method,
            'gateway' => $this->gateway,
            'is_paid' => $this->is_paid,
            'paid_at' => $this->paid_at,
            'created_at' => $this->created_at
        ];
    }
}
