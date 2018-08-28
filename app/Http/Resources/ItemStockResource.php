<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ItemStockResource extends Resource
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
            'code' => $this->code,
            'depositor' => $this->depositor,
            'deposit' => (double)$this->deposit,
            'status' => $this->status,
            'item' => $this->item->id,
            'updatedAt' => $this->updated_at
        ];
    }
}
