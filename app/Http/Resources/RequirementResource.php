<?php

namespace App\Http\Resources;

use App\Http\Resources\Collections\FileCollection;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RequirementResource extends JsonResource
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
            'requirements' => $this->retrieveData($this->resource, 'attributes.requirements'),
            'files' => new FileCollection($this->retrieveData($this->resource, 'attributes.files')),
            'seo' => new SeoResource($this->retrieveData($this->resource, 'attributes.seo'))
        ];
    }
}
