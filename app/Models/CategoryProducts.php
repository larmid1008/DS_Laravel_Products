<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\CategoryProducts
 *
 * @property int $category_id
 * @property int $product_id
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProducts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProducts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProducts query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProducts whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProducts whereProductId($value)
 * @mixin \Eloquent
 */
class CategoryProducts extends Pivot
{
    use HasFactory;
}
