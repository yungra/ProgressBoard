<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'id' => $this->id,
            'is_student' => $this->is_student,
            'content' => $this->content,
            'created_at' => $this->created_at,
            // 'user' => [
            //     'name' => $this->user->name,
            // ]
        ];
    }
}
