<?php

namespace App\Enums;

enum ProjectStatusEnum: string
{
    case IN_PROGRESS = 'В работе';
    case SUCCESS = 'Успешно закрыт';
    case FAIL = 'Закрыт не успешно';
}
