<?php

namespace App\ReferenceBook\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BuildingsCollectResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'country'=>$this->building->country,
            'city'=>$this->building->city,
            'street'=>$this->building->street,
            'house'=>$this->building->house,
        ];
    }
}
