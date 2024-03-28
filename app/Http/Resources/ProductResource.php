<?php

namespace App\Http\Resources;

use App\Traits\HelperTrait;
use App\Http\Resources\Collections\ProductCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    use HelperTrait;

    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->resource?->product['title'],
            'description' => $this->resource?->product['description'],
            'shortDescription' => $this->resource?->product['shortDescription'],
            'benefit' => $this->resource?->product['benefit'],
            'slug' => $this->resource?->product['slug'],
            'image' => config('services.strapi.url') . $this->resource?->product['image']['data']['attributes']['url'],
            'icon' => config('services.strapi.url') . $this->resource?->product['icon']['data']['attributes']['url'],
            'materials' => array_key_exists('materials', $this->resource?->product) ?
                collect($this->resource?->product['materials']['data'])->map(function ($item) {
                    return [
                        'title' => $item['attributes']['title'],
                        'description' => $item['attributes']['description'],
                        'image' => config('services.strapi.url') . $item['attributes']['image']['data']['attributes']['url'],
                    ];
                }) : [],
            'examples' => array_key_exists('examples', $this->resource?->product) ?
                collect($this->resource?->product['examples']['data'])->map(function ($item) {
                    return [
                        'title' => $item['attributes']['title'],
                        'description' => $item['attributes']['description'],
                        'material' => $item['attributes']['material'],
                        'image' => config('services.strapi.url') . $item['attributes']['image']['data']['attributes']['url'],
                    ];
                }) : [],
            'others' => $this->when(property_exists($this->resource, 'others'), function () {
                $others = collect($this->resource->others)->map(function ($item) {
                    $other = new \stdClass();
                    $other->product = $item;
                    return $other;
                })->toArray();
                return new ProductCollection($others);
            })
        ];
    }
}
