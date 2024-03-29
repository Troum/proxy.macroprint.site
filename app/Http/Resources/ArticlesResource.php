<?php

namespace App\Http\Resources;

use App\Http\Resources\Collections\FileCollection;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticlesResource extends JsonResource
{
    use HelperTrait;

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'title' => $this->resource['attributes']['title'],
            'description' => $this->resource['attributes']['description'],
            'image' => [
                'url' => $this->resource['attributes']['image']['data']['attributes']['url']
            ],
            'date' => $this->resource['attributes']['createdAt'],
            'seo' => new SeoResource($this->resource['attributes']['seo']),
        ];
    }
}
