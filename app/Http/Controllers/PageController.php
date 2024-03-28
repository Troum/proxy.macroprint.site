<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticlesResource;
use App\Http\Resources\Collections\ArticleCollection;
use App\Http\Resources\Collections\ProductCollection;
use App\Http\Resources\Collections\SlideCollection;
use App\Http\Resources\Collections\VacancyCollection;
use App\Http\Resources\ProductResource;
use App\Http\Resources\RequirementResource;
use App\Http\Resources\RequisiteResource;
use App\Http\Resources\SeoResource;
use App\Traits\HelperTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class PageController extends Controller
{
    use HelperTrait;

    /**
     * @return JsonResponse
     */
    public function indexPage(): JsonResponse
    {
        try {

            $index = Http::strapi()->get('/index?populate=*');
            $products = Http::strapi()->get('/products?populate[image][fields]=url&populate[icon][fields]=url&populate[materials][fields]=*&populate[examples][fields]=*');
            $articles = Http::strapi()->get('/articles?populate[seo][fields]=*&populate[image][fields]=url');
            $vacancies = Http::strapi()->get('/vacancies?populate=*');


            $result = [
                'seo' => $index['data'],
                'slides' => $index['data'],
                'products' => $products['data'],
                'articles' => $articles['data'],
                'vacancies' => $vacancies['data']
            ];

            return response()->json($result);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage(), 'trace' => $exception->getTrace()]);
        }
    }

    /**
     * @return JsonResponse
     */
    public function requisitesPage(): JsonResponse
    {
        try {
            $page = Http::strapi()->get('/requisite?populate=seo');
            return response()->json(new RequisiteResource($page['data']));
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage(), 'trace' => $exception->getTrace()]);
        }
    }

    /**
     * @return JsonResponse
     */
    public function requirementsPage(): JsonResponse
    {
        try {
            $page = Http::strapi()->get('/technical-requirement?populate[files][populate][file][fields][0]=url&populate[seo][fields]=*&populate[requirements][fields]=*');
            return response()->json(new RequirementResource($page['data']));
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage(), 'trace' => $exception->getTrace()]);
        }
    }

    /**
     * @param string $slug
     * @return JsonResponse
     */
    public function productPage(string $slug): JsonResponse
    {
        try {
            $product = Http::strapi()->get('/products?filters[slug][$eq]='. $slug .'&populate[icon][fields][0]=url&populate[image][fields][0]=url&populate[seo][fields]=*&populate[materials][populate][image][fields][0]=url&populate[examples][populate][image][fields][0]=url');
            $products = Http::strapi()->get('/products?sort[0]=createdAt:desc&populate[image][fields][0]=url&populate[icon][fields][0]=url');

            $others = collect($products['data'])
                ->filter(function ($item) use ($product) {
                    return $this->retrieveData($product['data'], '0.id') !== $item['id'];
                })->values()->map(fn ($item) => $item['attributes'])->toArray();

            $prod = new \stdClass();
            $prod->product = $product['data'][0]['attributes'];
            $prod->others = $others;


            return response()->json(new ProductResource($prod));
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage(), 'trace' => $exception->getTrace()]);
        }
    }

    /**
     * @return JsonResponse
     */
    public function companyArticles(): JsonResponse
    {
        try {
            $articles = Http::strapi()->get('/articles?sort[0]=createdAt:desc&populate[image][fields][0]=url');
            $page = Http::strapi()->get('/company-article?populate[seo][fields]=*');

            return response()->json([
                'articles' => new ArticleCollection($articles['data']),
                'page' => !is_null($page['data']) ? new ArticlesResource($page['data']) : []
            ]);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage(), 'trace' => $exception->getTrace()]);
        }
    }

    /**
     * @param string $slug
     * @return JsonResponse
     */
    public function companyArticle(string $slug): JsonResponse
    {
        return $this->productPage($slug);
    }
}