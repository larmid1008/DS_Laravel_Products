<?php

namespace App\Http\DTO\Category;

use Spatie\DataTransferObject\DataTransferObject;

class DeleteCategoryDTO extends DataTransferObject
{
    public int $id;
}
