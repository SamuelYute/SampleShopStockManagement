<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CommentResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {       return [
                'id' => $this->id,
                'text' => $this->text,
                'commentedBy' => $this->username,
                'item' => $this->item_id,
                'creeatedAt' => $this->created_at
            ];
    }
}
