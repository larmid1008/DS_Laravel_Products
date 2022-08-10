<?php

namespace App\Http\DTO\Product;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

class CreateProductDTO extends DataTransferObject
{
    public string $name;
    public ?string $description;
    public ?float $price = 0.00;
    public ?string $picture;
    #[MapFrom('is_publish')]
    public ?bool $isPublish;
    #[MapFrom('categories_id')]
    public ?array $categoriesId = [];
}
