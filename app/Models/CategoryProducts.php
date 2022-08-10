<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\CategoryProducts
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProducts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProducts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryProducts query()
 * @mixin \Eloquent
 */
class CategoryProducts extends Pivot
{
    use HasFactory;
}
