<?php

namespace App\Http\Resources;

use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SlideResource extends JsonResource
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
            'image' => $this->retrieveData($this->resource, 'attributes.url')
        ];
    }
}
