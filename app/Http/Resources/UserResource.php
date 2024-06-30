<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'position' => $this->position,
            'playerSkills' => $this->skills($this->skills)
        ];
    }

    private function skills($skills)
    {
        $result=[];
        foreach($skills as $skill) {
            $result[]=[
                'skills' => $skill->skill,
                'values' => $skill->value
            ];
        }
        return $result;
    }
}
