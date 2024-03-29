<?php

namespace App\Http\Resources;

use App\Traits\HelperTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
{
    use HelperTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->retrieveData($this->resource, 'attributes.title'),
            'description' => $this->retrieveData($this->resource, 'attributes.description'),
            'requirements' => $this->retrieveData($this->resource, 'attributes.requirements'),
            'date' => Carbon::parse($this->retrieveData($this->resource, 'attributes.createdAt'))->format('d/m/Y')
        ];
    }
}
