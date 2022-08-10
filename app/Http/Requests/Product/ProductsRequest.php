<?php

namespace App\Http\Requests\Product;

use App\Http\Requests\PaginateRequest;

class ProductsRequest extends PaginateRequest
{
    /**
     * @return string|null
     */
    public function getSearch(): ?string
    {
        return $this->get('search');
    }
}
