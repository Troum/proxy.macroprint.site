<?php

namespace App\Traits;

use Illuminate\Support\Arr;

trait HelperTrait
{
    /**
     * @param array $array
     * @param string $key
     * @return mixed
     */
    public function retrieveData(array $array, string $key): mixed
    {
        return Arr::get($array, $key);
    }
}
