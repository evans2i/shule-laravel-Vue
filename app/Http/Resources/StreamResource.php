<?php

namespace App\Http\Resources;

use App\Http\Resources\LevelResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StreamResource extends JsonResource
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
            'levels' => LevelResource::collection($this->levels),
            'results' => $this->resultsall(),
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
