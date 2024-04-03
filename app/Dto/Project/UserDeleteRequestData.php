<?php

namespace App\Dto\Project;

use App\Dto\BaseDto;
use Spatie\LaravelData\Attributes\MapName;

class UserDeleteRequestData extends BaseDto
{
    public function __construct(
        #[MapName('user_id')]
        public string $userId,
        #[MapName('project_id')]
        public string $projectId,
    ) {
        //
    }

    public static function rules(): array
    {
        return [
            'user_id' => 'required|int',
            'project_id' => 'required|string',
        ];
    }
}