<?php

namespace App\Http\Resources;

use App\Traits\HelperTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'title' => $this->retrieveData($this->resource, 'attributes.title'),
            'description' => $this->retrieveData($this->resource, 'attributes.description'),
            'image' => $this->retrieveData($this->resource,'attributes.image.data.attributes.url'),
            'date' => Carbon::parse($this->retrieveData($this->resource, 'attributes.createdAt'))->format('d/m/Y')
        ];
    }
}
