<?php

namespace App\ReferenceBook\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrganizationCollectResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            $this->collection->map(function ($organization) {
                return OrganizationJsonResource::make($organization);
            })
        ];
    }
}
