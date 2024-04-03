<?php

namespace App\Dto\Project;

use App\Dto\BaseDto;
use App\Enums\ProjectStatusEnum;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MapName;

class ProjectUpdateRequestData extends BaseDto
{
    public function __construct(
        #[MapName('project_id')]
        public string $projectId,
        public string $name,
        public string $description,
        public string $status,
    ) {
    }

    public static function rules(): array
    {
        return [
            'project_id' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|string',
            'status' => Rule::in(array_column(ProjectStatusEnum::cases(), 'value'))
        ];
    }
}