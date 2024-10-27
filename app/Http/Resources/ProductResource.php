<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
      //  return parent::toArray($request);

      return [
        'id' => $this->id,
        'name' => $this->name,
        'price' => $this->price,
        'quantity' => $this->quantity,
        'category' => $this->category,
        'description' => $this->description,
        'barcode' => $this->barcode
      ];
    }
}
