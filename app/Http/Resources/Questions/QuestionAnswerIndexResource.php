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
class QuestionAnswerIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $answer = null;
        if ($this->answer){
            $answer = json_decode($this->answer);
        }
        return [
            'id' => $this->id,
            'question_id' => $this->question_id,
            'answer' => $answer,
            'is_special' => $this->is_special,
            'is_active' => $this->is_active,
        ];
    }
}
