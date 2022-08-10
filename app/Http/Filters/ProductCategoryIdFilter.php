<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class ProductCategoryIdFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->whereHas('categories', function (Builder $builder) use ($value) {
            $builder->whereIn('categories.id', is_array($value) ? $value : [$value]);
        });
    }
}
