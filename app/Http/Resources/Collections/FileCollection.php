<?php

namespace App\Http\Resources\Collections;

use App\Http\Resources\FileResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class FileCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return AnonymousResourceCollection
     */
    public function toArray($request): AnonymousResourceCollection
    {
        return FileResource::collection($this->collection);
    }
}
