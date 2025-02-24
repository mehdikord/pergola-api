<?php

namespace App\Http\Resources\Questions;

use App\Http\Resources\Colors\ColorShortResource;
use App\Http\Resources\Options\OptionShortResource;
use App\Models\Option;
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
        $items = [];
        if ($this->items){
            $get_items = json_decode($this->items, false, 512, JSON_THROW_ON_ERROR);
            foreach ($get_items as $item){
                $option = Option::find($item->id);
                if ($option){
                    $items[]=[
                        'option' => new OptionShortResource($option),
                        'value' => $item->value,
                    ];
                }
            }

        }

        return [
            'id' => $this->id,
            'from_color_id' => $this->from_color_id,
            'to_color_id' => $this->to_color_id,
            'items' => $items,
            'from_color' => new ColorShortResource($this->from_color),
            'to_color' => new ColorShortResource($this->to_color),
            'answers' => QuestionAnswerIndexResource::collection($this->answers),
            'is_active' => $this->is_active,
        ];
    }
}
