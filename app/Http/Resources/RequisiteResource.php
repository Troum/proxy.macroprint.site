<?php

namespace App\Http\Resources;

use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequisiteResource extends JsonResource
{
    use HelperTrait;

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->retrieveData($this->resource, 'attributes.title'),
            'description' => $this->retrieveData($this->resource, 'attributes.description'),
            'seo' => new SeoResource($this->retrieveData($this->resource, 'attributes.seo'))
        ];
    }
}
