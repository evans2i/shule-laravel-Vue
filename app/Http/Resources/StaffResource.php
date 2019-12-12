<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'position' => $this->position,
            'slug' => $this->slug,
            'qualification' => $this->qualification,
            'employed_date' => $this->employed_date,
            'user' => $this->user->name,
            'last_name' => $this->user->last_name,
            'email' => $this->user->email,
            'address' => $this->user->address,
            'phone' => $this->user->phone,
            'user_id' => $this->user_id,
            'path' => $this->path,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
