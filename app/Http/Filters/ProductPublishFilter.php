<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class ProductPublishFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if ($value === "true") {
            $query->whereNotNull($property);
        } else {
            $query->whereNull($property);
        }
    }
}
