<?php

namespace App\Http\Resources;

use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyArticleResource extends JsonResource
{
    use HelperTrait;
    public $additional;
    public function __construct($resource, array $additional)
    {
        $this->additional = $additional;
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'title' => $this->retrieveData($this->resource, 'data.attributes.title'),

        ];
    }
}
