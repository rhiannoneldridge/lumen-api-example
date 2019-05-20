<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use App\Models\User;
use App\Repositories\UserRepository;

class RoleUserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * UserController constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = new UserRepository($user);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{user_id}/roles",
     *     tags={"userRoles"},
     *     summary="Assign User Roles",
     *     operationId="assignUserRoles",
     *     @OA\Response(
     *         response="200",
     *         description="Array of all Roles assigned to this User",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Role")
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         request="RoleIds",
     *         description="Role ID(s) to assign",
     *         required=true,
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="integer",
     *                 format="int64"
     *             )
     *         )
     *     )
     * )
     */

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function assignUserRoles(Request $request, $id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (false === $id) {
            return response('User ID is not a valid integer.', 422);
        }

        $roleIds = json_decode($request->getContent(), true);

        if (empty($roleIds) || !is_array($roleIds)) {
            return response('Invalid Role IDs.', 422);
        }

        $roleIds = array_values($roleIds);

        $roleIdsFiltered = [];

        foreach ($roleIds as $roleId) {
            $roleId = filter_var($roleId, FILTER_VALIDATE_INT);

            if (false === $roleId) {
                return response('Role ID is not a valid integer.', 422);
            }

            $roleIdsFiltered[] = $roleId;
        }

        $user = $this->user->get($id);

        $this->user->setModel($user);

        $this->user->assignRolesToUser($roleIdsFiltered);

        return $this->user->getRolesFromUser();
    }

    /**
     * @OA\Put(
     *     path="/api/users/{user_id}/roles/{role_id}",
     *     tags={"userRoles"},
     *     summary="Assign User Role",
     *     operationId="assignUserRole",
     *     @OA\Response(
     *         response="200",
     *         description="Array of all Roles assigned to this User",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Role")
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="role_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     )
     * )
     */

    /**
     * @param int $userId
     * @param int $roleId
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function assignUserRole($userId, $roleId)
    {
        $userId = filter_var($userId, FILTER_VALIDATE_INT);

        if (false === $userId) {
            return response('User ID is not a valid integer.', 422);
        }

        $roleId = filter_var($roleId, FILTER_VALIDATE_INT);

        if (false === $roleId) {
            return response('Role ID is not a valid integer.', 422);
        }

        $user = $this->user->get($userId);

        $this->user->setModel($user);

        $this->user->assignRolesToUser(Arr::wrap($roleId));

        return $this->user->getRolesFromUser();
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{user_id}/roles/{role_id}",
     *     tags={"userRoles"},
     *     summary="Delete User Role",
     *     operationId="deleteUserRole",
     *     @OA\Response(
     *         response="200",
     *         description="Array of all Roles assigned to this User",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Role")
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="role_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     )
     * )
     */

    /**
     * @param int $userId
     * @param int $roleId
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function removeUserRole($userId, $roleId)
    {
        $userId = filter_var($userId, FILTER_VALIDATE_INT);

        if (false === $userId) {
            return response('User ID is not a valid integer.', 422);
        }

        $roleId = filter_var($roleId, FILTER_VALIDATE_INT);

        if (false === $roleId) {
            return response('Role ID is not a valid integer.', 422);
        }

        $user = $this->user->get($userId);

        $this->user->setModel($user);

        $this->user->removeRolesFromUser(Arr::wrap($roleId));

        return $this->user->getRolesFromUser();
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{user_id}/roles",
     *     tags={"userRoles"},
     *     summary="Delete All User Roles",
     *     operationId="deleteUserRoles",
     *     @OA\Response(
     *         response="200",
     *         description="The User has had their Roles deleted"
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     )
     * )
     */

    /**
     * @param int $userId
     * @return bool|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function removeAllUserRoles($userId)
    {
        $userId = filter_var($userId, FILTER_VALIDATE_INT);

        if (false === $userId) {
            return response('User ID is not a valid integer.', 422);
        }

        $user = $this->user->get($userId);

        $this->user->setModel($user);

        $roles = $this->user->getRolesFromUser();

        $roleIds = Arr::pluck($roles, 'id');

        $this->user->removeRolesFromUser($roleIds);

        return response('Removed All Roles from User', 200);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{user_id}/roles/{role_id}",
     *     tags={"userRoles"},
     *     summary="Get Role from User",
     *     operationId="getUser",
     *     @OA\Response(
     *         response="200",
     *         description="Array of all Roles assigned to this User",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Role")
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="role_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     )
     * )
     */

    /**
     * @param int $userId
     * @param int $roleId
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function getUserRole($userId, $roleId)
    {
        $userId = filter_var($userId, FILTER_VALIDATE_INT);

        if (false === $userId) {
            return response('User ID is not a valid integer.', 422);
        }

        $roleId = filter_var($roleId, FILTER_VALIDATE_INT);

        if (false === $roleId) {
            return response('Role ID is not a valid integer.', 422);
        }

        $user = $this->user->get($userId);

        $this->user->setModel($user);

        return $this->user->getRoleFromUser($roleId);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{user_id}/roles",
     *     tags={"userRoles"},
     *     summary="Get All Roles from User",
     *     operationId="getAllUserRoles",
     *     @OA\Response(
     *         response="200",
     *         description="Array of all Roles assigned to this User",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Role")
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     )
     * )
     */

    /**
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function getUserRoles($userId)
    {
        $userId = filter_var($userId, FILTER_VALIDATE_INT);

        if (false === $userId) {
            return response('User ID is not a valid integer.', 422);
        }

        $user = $this->user->get($userId);

        $this->user->setModel($user);

        return $this->user->getRolesFromUser();
    }
}
