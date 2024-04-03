<?php

namespace App\Dto\Project;

use App\Dto\BaseDto;
use Spatie\LaravelData\Attributes\MapName;

class ProjectDeleteRequestData extends BaseDto
{
    public function __construct(
        #[MapName('project_id')]
        public string $projectId,
    ) {
        //
    }

    public static function rules(): array
    {
        return [
            'project_id' => 'required|string'
        ];
    }
}