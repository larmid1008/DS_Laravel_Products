<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\DTO\Category\CreateCategoryDTO;
use App\Http\DTO\Category\DeleteCategoryDTO;
use App\Http\Handlers\Category\CreateCategoryHandler;
use App\Http\Handlers\Category\DeleteCategoryHandler;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Resources\Category\CategoryResponse;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    /**
     * @param PaginateRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(PaginateRequest $request): AnonymousResourceCollection
    {
        $categories = QueryBuilder::for(Category::class)
            ->paginate(perPage: $request->getPerPage(), page: $request->getPage());

        return CategoryResponse::collection($categories);
    }

    /**
     * @param CreateCategoryRequest $request
     * @param CreateCategoryHandler $handler
     * @return JsonResponse
     * @throws UnknownProperties
     */
    public function store(CreateCategoryRequest $request, CreateCategoryHandler $handler)
    {
        $dto = new CreateCategoryDTO($request->toArray());
        $category = $handler->handle($dto);

        return (CategoryResponse::make($category))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * @param int $id
     * @param DeleteCategoryHandler $handler
     * @return JsonResponse
     * @throws UnknownProperties
     */
    public function destroy(int $id, DeleteCategoryHandler $handler): JsonResponse
    {
        $dto = new DeleteCategoryDTO(id: $id);
        $handler->handle($dto);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
