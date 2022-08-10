<?php

namespace App\Http\DTO\Category;

use Spatie\DataTransferObject\DataTransferObject;

class CreateCategoryDTO extends DataTransferObject
{
    public string $name;
}
