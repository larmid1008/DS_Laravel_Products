<?php

namespace App\Http\Handlers\Category;

use App\Exceptions\Category\CategoryNotEmptyException;
use App\Http\DTO\Category\DeleteCategoryDTO;
use App\Http\Handlers\BaseHandler;
use App\Models\Category;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeleteCategoryHandler extends BaseHandler
{
    /**
     * @param DeleteCategoryDTO $dto
     * @return void
     * @throws CategoryNotEmptyException
     */
    protected function handleDTO($dto): void
    {
        $category = Category::withCount('products')->find($dto->id);
        if (!$category) {
            throw new NotFoundHttpException('Category not found');
        }

        if ($category->products_count) {
            throw new CategoryNotEmptyException();
        }

        $category->delete();
    }
}
