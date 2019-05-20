<?php

/**
 * @OA\Schema(
 *     schema="CreateUpdateUser",
 *     type="object",
 *     title="Create/Update User model",
 *     description="Create/Update User model",
 * @OA\Property(
 *     property="name",
 *     format="string",
 *     description="Name of User",
 *     title="Name",
 * ),
 * @OA\Property(
 *     property="email",
 *     format="email",
 *     description="Email Address of User",
 *     title="Email",
 * ),
 * @OA\Property(
 *     property="password",
 *     format="string",
 *     description="User password",
 *     title="Password",
 * ),
 * @OA\Property(
 *     property="api_token",
 *     format="string",
 *     description="API Token for this user",
 *     title="API Token",
 * )
 * )
 */