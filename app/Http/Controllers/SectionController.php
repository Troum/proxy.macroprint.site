<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class SectionController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getHeader(): JsonResponse
    {
        try {
            $products = Http::strapi()->get('/products?populate=*');
            $productLinks = [
                'products_links' => collect($products['data'])
                    ->map(function ($item) {
                        return [
                            'title' => Arr::get($item, 'attributes.title'),
                            'route' => '/products/' . Arr::get($item, 'attributes.slug'),
                        ];
                    })
            ];
            return response()->json($productLinks);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
