<?php

namespace App\Http\Resources;

use App\Http\Resources\LevelResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'parent_name' => $this->parent_name,
            'parent_work' => $this->parent_work,
            'slug' => $this->slug,
            'birth_date' => $this->birth_date,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'phone' => $this->user->phone,
            'last_name' => $this->user->last_name,
            'stream' => $this->stream->name,
            'path' => $this->path,
            'level' => $this->level,
            // 'results' => $this->stream->levels()->with('subjects.result')->get(),
            'date_registered' => $this->date_registered,
            'created_at' => $this->created_at->diffForHumans()
            //stream->levels()
            // ->with('subjects.result')
            // ->get();
        ];
    }
}
