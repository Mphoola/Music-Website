<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Music extends JsonResource
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
            'artist' => $this->artist,
            'producer' => $this->producer,
            'category' => $this->category->name,
            'user_id' => $this->user_id,
            'downloads_count' => $this->downloads_count,
            'location' => asset($this->location),
            'extension' => $this->extension,
            'released_date' => $this->released_date->toFormattedDateString(),
            'cover_image' => asset($this->cover_image),
            'market' => $this->market,
            'amount' => $this->amount,
            'size' => $this->getFileSize(),
            'uuid' => $this->uuid,
            'created_at' => $this->created_at,
            
        ];
    }
}
