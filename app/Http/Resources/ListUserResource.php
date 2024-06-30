<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $result=[];
        foreach ($this as $key => $values) {
            foreach ($values as $k => $user) {
                $result[] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'position' => $user->position,
                    'playerSkills' => $this->skills($user->skills)
                ];
            }
        };

        return $result;
    }

    private function skills($skills)
    {
        $result=[];
        foreach($skills as $skill) {
            $result[]=[
                'skills' => $skill->skill,
                'values' => $skill->value,
                'playerId' => $skill->user_id
            ];
        }
        return $result;
    }
}
