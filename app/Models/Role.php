<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Role",
 *     description="Role schema",
 * )
 */
class Role extends Model
{
    /**
     * @OA\Property(
     *     property="id",
     *     format="int64",
     *     description="ID of Role",
     *     title="ID",
     * )
     * @OA\Property(
     *     property="name",
     *     format="string",
     *     description="Name of Role",
     *     title="Name",
     * )
     * @OA\Property(
     *     property="created_at",
     *     format="string",
     *     description="Date Role was created",
     *     title="Created At",
     * )
     * @OA\Property(
     *     property="updated_at",
     *     format="string",
     *     description="Date Role was last updated",
     *     title="Updated At",
     * )
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that are hidden.
     *
     * @var array
     */
    protected $hidden =[
        'users',
    ];

    public function users()
    {
        $this->belongsToMany(User::class, 'role_user');
    }
}
