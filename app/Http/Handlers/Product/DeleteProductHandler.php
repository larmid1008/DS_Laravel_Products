<?php

namespace App\Http\Handlers\Product;

use App\Exceptions\Category\CategoryNotEmptyException;
use App\Http\DTO\Product\DeleteProductDTO;
use App\Http\Handlers\BaseHandler;
use App\Models\Product;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeleteProductHandler extends BaseHandler
{
    /**
     * @param DeleteProductDTO $dto
     * @return void
     * @throws NotFoundHttpException
     */
    protected function handleDTO($dto): void
    {
        $product = Product::find($dto->id);
        if (!$product) {
            throw new NotFoundHttpException('Product not found');
        }
        $product->delete();
    }
}
