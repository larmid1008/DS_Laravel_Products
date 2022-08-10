<?php

namespace App\Http\Handlers\Product;

use App\Exceptions\Category\CategoryNotEmptyException;
use App\Http\DTO\Product\CreateProductDTO;
use App\Http\Handlers\BaseHandler;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CreateProductHandler extends BaseHandler
{
    /**
     * @param CreateProductDTO $dto
     * @return Product
     */
    protected function handleDTO($dto): Product
    {
        $categoriesId = Category::whereIn('id', $dto->categoriesId)->pluck('id');
        $notFoundIds = array_diff($dto->categoriesId, $categoriesId->toArray());
        if (count($notFoundIds)) {
            throw new NotFoundHttpException(sprintf("Category '%s' not found", collect($notFoundIds)->join(', ')));
        }

        $publishAt = $dto->isPublish ? Carbon::now() : null;
        $product = Product::create([
            'name' => $dto->name,
            'description' => $dto->description,
            'price' => $dto->price,
            'picture' => $dto->picture,
            'publish_at' => $publishAt,
        ]);

        $product->categories()->sync($dto->categoriesId);

        return $product->load('categories');
    }
}
