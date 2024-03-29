<?php

namespace App\Http\Resources;

use App\Http\Resources\Collections\ArticleCollection;
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
            'title' => $this->resource->article['title'],
            'description' => $this->resource->article['description'],
            'image' => [
                'url' => $this->resource->article['image']['data']['attributes']['url']
            ],
            'date' => $this->resource->article['createdAt'],
            'seo' => new SeoResource($this->resource->article['seo']),
            'others' => $this->when(property_exists($this->resource->article, 'others'), function () {
                $others = collect($this->resource->others)->map(function ($item) {
                    $other = new \stdClass();
                    $other->article = $item;
                    return $other;
                })->toArray();
                return new ArticleCollection($others);
            })
        ];
    }
}
