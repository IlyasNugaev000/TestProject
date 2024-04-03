<?php

namespace App\Dto\Project;

use App\Dto\BaseDto;

class ProjectStoreRequestData extends BaseDto
{
    public function __construct(
        public string $name,
        public string $description,
    ) {
    }

    public static function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string'
        ];
    }
}