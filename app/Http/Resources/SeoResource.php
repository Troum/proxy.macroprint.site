<?php

namespace App\Http\Resources;

use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeoResource extends JsonResource
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
            'title' => $this->retrieveData($this->resource, 'title'),
            'description' => $this->retrieveData($this->resource, 'description'),
            'og_title' => $this->retrieveData($this->resource, 'og_title'),
            'og_description' => $this->retrieveData($this->resource, 'og_description')
        ];
    }
}
