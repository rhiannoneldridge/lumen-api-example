<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Repositories\UserRepository;

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
     *     summary="Create User",
     *     operationId="createUser",
     *     @OA\Response(
     *         response="200",
     *         description="User Created"
     *     ),
     *     @OA\RequestBody(
     *         description="Create User object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateUpdateUser")
     *     )
     * )
     */

    /**
     * @param Request $request
     * @return UserRepository|\Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createUser(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|string',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|string',
            'api_token'     => 'required|unique:users',
        ]);

        return $this->user->create($request->only($this->user->getModel()->getFillable()));
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *     tags={"users"},
     *     summary="Update User",
     *     operationId="updateUser",
     *     @OA\Response(
     *         response="200",
     *         description="User Updated",
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
     *     ),
     *     @OA\RequestBody(
     *         description="Update User object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateUpdateUser")
     *     )
     * )
     */

    /**
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|\Illuminate\Http\Response|\Illuminate\Support\Collection|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateUser(Request $request, $id)
    {
        $this->validate($request, [
            'name'          => 'sometimes|string',
            'email'         => 'sometimes|email|unique:users',
            'password'      => 'sometimes|string',
            'api_token'     => 'sometimes|unique:users',
        ]);

        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (false === $id) {
            return response('ID is not a valid integer.', 422);
        }

        $this->user->update($request->only($this->user->getModel()->getFillable()), $id);

        return $this->user->with(['roles'])->get($id);
    }

    /**
     * @OA\Delete(
     *     path="/api/users/{id}",
     *     tags={"users"},
     *     summary="Delete User",
     *     operationId="deleteUser",
     *     @OA\Response(
     *         response="200",
     *         description="The User has been deleted"
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

        if (!$this->user->delete($id)) {
            return response('Unable to delete User.', 422);
        }

        return response('User has been deleted.', 200);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *     tags={"users"},
     *     summary="Get User",
     *     operationId="getUser",
     *     @OA\Response(
     *         response="200",
     *         description="The specified User",
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
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]|\Illuminate\Http\Response|\Illuminate\Support\Collection|\Laravel\Lumen\Http\ResponseFactory
     */
    public function getUser($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (false === $id) {
            return response('ID is not a valid integer.', 422);
        }

        return $this->user->get($id);
    }

    /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"users"},
     *     summary="Get All Users",
     *     operationId="getUsers",
     *     @OA\Response(
     *         response="200",
     *         description="Array of all Users",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/User")
     *         )
     *     )
     * )
     */

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAllUsers()
    {
        return $this->user->all();
    }
}
