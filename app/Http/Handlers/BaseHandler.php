<?php

namespace App\Http\Handlers;

use Illuminate\Support\Facades\DB;
use Spatie\DataTransferObject\DataTransferObject;

abstract class BaseHandler
{
    protected bool $isTransactional = true;
    protected int $numberOfAttempts = 1;

    abstract protected function handleDTO($dto);

    final public function handle(DataTransferObject $dto) {
        if (!$this->isTransactional) {
            return $this->handleDTO($dto);
        }

        return DB::transaction(function() use($dto) {
            return $this->handleDTO($dto);
        }, $this->numberOfAttempts);
    }

}
