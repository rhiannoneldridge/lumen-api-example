<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User schema",
 * )
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, SoftDeletes;

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
        'password', 'pivot',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
}
