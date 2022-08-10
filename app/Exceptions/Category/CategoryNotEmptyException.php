<?php

namespace App\Exceptions\Category;

use Throwable;

class CategoryNotEmptyException extends \Exception
{
    public function __construct(string $message = "Category not empty!", int $code = 403, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
