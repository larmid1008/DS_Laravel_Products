<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\Product\ProductResponse;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductsController extends Controller
{
    /**
     * @param PaginateRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(PaginateRequest $request): AnonymousResourceCollection
    {
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::exact('category_id'),
            ])
            ->paginate(perPage: $request->getPerPage(), page: $request->getPage());

        return ProductResponse::collection($products);
    }
}
