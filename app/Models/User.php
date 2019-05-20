<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User schema",
 * )
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * @OA\Property(
     *     property="id",
     *     format="int64",
     *     description="ID of User",
     *     title="ID",
     * )
     * @OA\Property(
     *     property="name",
     *     format="string",
     *     description="Name of User",
     *     title="Name",
     * )
     * @OA\Property(
     *     property="email",
     *     format="email",
     *     description="Email Address of User",
     *     title="Email",
     * )
     * @OA\Property(
     *     property="api_token",
     *     format="string",
     *     description="API Token for this User",
     *     title="API Token",
     * )
     * @OA\Property(
     *     property="created_at",
     *     format="string",
     *     description="Date User was created",
     *     title="Created At",
     * )
     * @OA\Property(
     *     property="updated_at",
     *     format="string",
     *     description="Date User was last updated",
     *     title="Updated At",
     * )
     * @OA\Property(
     *     property="roles",
     *     description="Roles assigned to this User",
     *     title="Roles",
     *     type="array",
     *     @OA\Items(
     *         ref="#/components/schemas/Role"
     *     )
     * )
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function roles()
    {
        $this->belongsToMany(Role::class, 'role_user');
    }
}
