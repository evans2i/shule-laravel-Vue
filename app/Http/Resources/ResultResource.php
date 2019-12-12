<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
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
            'marks' => $this->marks,
            'level' => $this->level->name,
            'subject' => $this->subject->name,
            'stream' => $this->stream->name,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
