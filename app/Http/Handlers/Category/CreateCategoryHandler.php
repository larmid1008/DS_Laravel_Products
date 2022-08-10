<?php

namespace App\Http\Handlers\Category;

use App\Http\DTO\Category\CreateCategoryDTO;
use App\Http\Handlers\BaseHandler;
use App\Models\Category;

class CreateCategoryHandler extends BaseHandler
{
    /**
     * @param CreateCategoryDTO $dto
     * @return Category
     */
    protected function handleDTO($dto): Category
    {
        return Category::create([
            'name' => $dto->name,
        ]);
    }
}
