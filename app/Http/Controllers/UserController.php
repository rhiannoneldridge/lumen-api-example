<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
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
     * @OA\Post(
     *     path="/api/users",
     *     tags={"users"},
     *     summary="Create user",
     *     operationId="createUser",
     *     @OA\Response(
     *         response="200",
     *         description="User Created"
     *     ),
     *     @OA\RequestBody(
     *         description="Create user object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateUpdateUser")
     *     )
     * )
     */

    /**
     * @param Request $request
     * @return UserRepository|\Illuminate\Database\Eloquent\Model
     */
    public function createUser(Request $request)
    {
        return $this->user->create($request->only($this->user->getModel()->getFillable()));
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     tags={"users"},
     *     summary="Update user",
     *     operationId="updateUser",
     *     @OA\Response(
     *         response="200",
     *         description="User Updated"
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
     *         description="Update user object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateUpdateUser")
     *     )
     * )
     */

    /**
     * @param Request $request
     * @param int $id
     * @return bool
     */
    public function updateUser(Request $request, $id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (false === $id) {
            return response('ID is not a valid integer.', 422);
        }

        return $this->user->update($request->only($this->user->getModel()->getFillable()), $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     tags={"users"},
     *     summary="Delete user",
     *     operationId="deleteUser",
     *     @OA\Response(
     *         response="200",
     *         description="The user has been deleted"
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
    public function deleteUser($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (false === $id) {
            return response('ID is not a valid integer.', 422);
        }

        return $this->user->delete($id);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     tags={"users"},
     *     summary="Get user",
     *     operationId="getUser",
     *     @OA\Response(
     *         response="200",
     *         description="The specified user",
     *         @OA\JsonContent(ref="#/components/schemas/User")
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
     * @return UserRepository|\Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory|mixed
     */
    public function getUser($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (false === $id) {
            return response('ID is not a valid integer.', 422);
        }

        return $this->user->get($id);
    }
}
