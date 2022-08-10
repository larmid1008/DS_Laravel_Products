<?php

namespace App\Http\DTO\Product;

use Spatie\DataTransferObject\DataTransferObject;

class DeleteProductDTO extends DataTransferObject
{
    public int $id;
}
