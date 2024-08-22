<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Restaurant extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'province' => $this->province,
            'postal_code' => $this->postal_code,
            'country' => $this->country,
            'cuisine' => $this->cuisine,
            'opening_hours' => $this->opening_hours,
            'status' => $this->status,
            'logo' => $this->getFirstMediaUrl('logo'),
            'gallery' => $this->getMedia('gallery')->map(function($item){
                return $item->getUrl();
            }),
        ];
//        return parent::toArray($request);
    }
}
