<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\DTO\Product\CreateProductDTO;
use App\Http\DTO\Product\DeleteProductDTO;
use App\Http\Filters\ProductCategoryIdFilter;
use App\Http\Filters\ProductCategoryNameFilter;
use App\Http\Filters\ProductPublishFilter;
use App\Http\Handlers\Product\CreateProductHandler;
use App\Http\Handlers\Product\DeleteProductHandler;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\ProductsRequest;
use App\Http\Resources\Product\ProductResponse;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ProductsController extends Controller
{
    /**
     * @param ProductsRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(ProductsRequest $request): AnonymousResourceCollection
    {
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::custom('category_id', new ProductCategoryIdFilter),
                AllowedFilter::callback('category_name', new ProductCategoryNameFilter),
                AllowedFilter::callback('price_start', function (Builder $builder, $value) {
                    $builder->where('price', '>=', $value);
                }),
                AllowedFilter::callback('price_end', function (Builder $builder, $value) {
                    $builder->where('price', '<=', $value);
                }),
                /**
                 * WITH
                 * Get all with trashed
                 *
                 * ONLY
                 * Get only transhed
                 */
                AllowedFilter::trashed(),
                AllowedFilter::custom('is_publish', new ProductPublishFilter, 'publish_at')
            ])
            ->when($request->getSearch(), function (Builder $builder, string $searchValue) {
                // TODO: Added Trgm extension for FullText search
                $builder->where("name", "like", "%$searchValue%");
            })
            ->with('categories')
            ->paginate(perPage: $request->getPerPage(), page: $request->getPage());

        return ProductResponse::collection($products);
    }

    /**
     * @param CreateProductRequest $request
     * @param CreateProductHandler $handler
     * @return JsonResponse
     * @throws UnknownProperties
     */
    public function store(CreateProductRequest $request, CreateProductHandler $handler)
    {
        $dto = new CreateProductDTO($request->toArray());
        $product = $handler->handle($dto);

        return (ProductResponse::make($product))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @param DeleteProductHandler $handler
     * @return JsonResponse
     * @throws UnknownProperties
     */
    public function destroy(int $id, DeleteProductHandler $handler): JsonResponse
    {
        $dto = new DeleteProductDTO(id: $id);
        $handler->handle($dto);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
