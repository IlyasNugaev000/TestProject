<?php

namespace App\Dto\Project;

use App\Dto\BaseDto;
use Spatie\LaravelData\Attributes\MapName;

class UserCreateRequestData extends BaseDto
{
    public function __construct(
        #[MapName('user_email')]
        public string $userEmail,
        #[MapName('project_id')]
        public string $projectId,
    ) {
        //
    }

    public static function rules(): array
    {
        return [
            'user_email' => 'required|email',
            'project_id' => 'required|string',
        ];
    }
}