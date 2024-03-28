<?php

namespace App\Http\Resources;

use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
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
            'link' => $this->retrieveData($this->resource, 'file.data.attributes.url')
        ];
    }
}
