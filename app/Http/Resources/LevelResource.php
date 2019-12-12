<?php

namespace App\Http\Resources;

use App\Http\Resources\SubjectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LevelResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'path' => $this->path,
            'subjects' => SubjectResource::collection($this->subjects),
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
