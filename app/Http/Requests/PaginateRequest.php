<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'page' => 'int',
            'perPage' => 'int',
        ];
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->get('page', 1);
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->get('perPage', 15);
    }
}
