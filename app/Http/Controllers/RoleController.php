<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;
use App\Repositories\RoleRepository;

class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $role;

    /**
     * RoleController constructor.
     *
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->role = new RoleRepository($role);
    }

    /**
     * @OA\Post(
     *     path="/api/roles",
     *     tags={"roles"},
     *     summary="Create Role",
     *     operationId="createRole",
     *     @OA\Response(
     *         response="200",
     *         description="Role Created",
     *         @OA\JsonContent(ref="#/components/schemas/Role")
     *     ),
     *     @OA\RequestBody(
     *         description="Create Role object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateUpdateRole")
     *     )
     * )
     */

    /**
     * @param Request $request
     * @return RoleRepository|\Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createRole(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles',
        ]);

        return $this->role->create($request->only($this->role->getModel()->getFillable()));
    }

    /**
     * @OA\Put(
     *     path="/api/roles/{id}",
     *     tags={"roles"},
     *     summary="Update Role",
     *     operationId="updateRole",
     *     @OA\Response(
     *         response="200",
     *         description="Role Updated",
     *         @OA\JsonContent(ref="#/components/schemas/Role")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         description="Update Role object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateUpdateRole")
     *     )
     * )
     */

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateRole(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles',
        ]);

        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (false === $id) {
            return response('ID is not a valid integer.', 422);
        }

        $this->role->update($request->only($this->role->getModel()->getFillable()), $id);

        return $this->role->get($id);
    }

    /**
     * @OA\Delete(
     *     path="/api/roles/{id}",
     *     tags={"roles"},
     *     summary="Delete Role",
     *     operationId="deleteRole",
     *     @OA\Response(
     *         response="200",
     *         description="The Role has been deleted"
     *     ),
     *     @OA\Parameter(
     *         name="id",
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
     * @param int $id
     * @return \Illuminate\Http\Response|int|\Laravel\Lumen\Http\ResponseFactory
     */
    public function deleteRole($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (false === $id) {
            return response('ID is not a valid integer.', 422);
        }

        if (!$this->role->delete($id)) {
            return response('Unable to delete Role.', 422);
        }

        return response('Role has been deleted.', 200);
    }

    /**
     * @OA\Get(
     *     path="/api/roles/{id}",
     *     tags={"roles"},
     *     summary="Get Role",
     *     operationId="getRole",
     *     @OA\Response(
     *         response="200",
     *         description="The specified Role",
     *         @OA\JsonContent(ref="#/components/schemas/Role")
     *     ),
     *     @OA\Parameter(
     *         name="id",
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
     * @param int $id
     * @return RoleRepository|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory|mixed
     */
    public function getRole($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (false === $id) {
            return response('ID is not a valid integer.', 422);
        }

        return $this->role->get($id);
    }

    /**
     * @OA\Get(
     *     path="/api/roles",
     *     tags={"roles"},
     *     summary="Get All Roles",
     *     operationId="getRoles",
     *     @OA\Response(
     *         response="200",
     *         description="Array of all Roles",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Role")
     *         )
     *     )
     * )
     */

    /**
     * @return RoleRepository[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllRoles()
    {
        return $this->role->all();
    }
}
