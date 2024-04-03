<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserProjectRole
 *
 * @property int $id
 * @property int $user_id
 * @property string $project_id
 * @property int $role_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserProjectRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProjectRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProjectRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProjectRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProjectRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProjectRole whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProjectRole whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProjectRole whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProjectRole whereUserId($value)
 * @mixin \Eloquent
 */
class UserProjectRole extends Model
{
    use HasFactory;

    protected $table = 'user_project_roles';
}
