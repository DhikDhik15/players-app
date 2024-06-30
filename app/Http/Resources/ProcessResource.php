<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $results=[];
        foreach ($this as $key => $values) {
            foreach ($values as $datas) {
                foreach ($datas as $data) {
                    $results[]=[
                        'name' => $data->name,
                        'position' => $data->position,
                        'playerSkills' => [
                            'skill' => $data->skill,
                            'value' => $data->value,
                        ]
                    ];
                }
            }
        }
        return $results;
    }
}
