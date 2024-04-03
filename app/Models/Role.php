<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const FULL_ACCESS = 1;
    const EDIT_ACCESS = 2;
    const READ_ACCESS = 3;
}
