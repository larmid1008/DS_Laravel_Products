<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class ProductCategoryNameFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->whereHas('categories', function (Builder $builder) use ($value) {
            $builder->where('categories.name', 'ilike', "%$value%");
        });
    }
}
