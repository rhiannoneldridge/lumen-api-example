<?php

/**
 * @OA\Info(
 *     description="This is a Users and Roles API using Lumen and Swagger",
 *     version="1.0.0",
 *     title="Users and Roles",
 *     @OA\Contact(
 *         email="rhiannon.eldridge.au@gmail.com"
 *     ),
 *     @OA\License(
 *         name="BY-NC-SA",
 *         url="https://creativecommons.org/licenses/by-nc-sa/4.0"
 *     )
 * )
 * @OA\Tag(
 *     name="roles",
 *     description="User Roles",
 *     @OA\ExternalDocumentation(
 *         description="Additional docs go here...",
 *         url="http://swagger.io"
 *     )
 * )
 * @OA\Tag(
 *     name="users",
 *     description="Users",
 *     @OA\ExternalDocumentation(
 *         description="Additional docs go here...",
 *         url="http://swagger.io"
 *     )
 * )
 * @OA\Server(
 *     description="Localhost Server",
 *     url="http://localhost:8000"
 * )
 * @OA\ExternalDocumentation(
 *     description="Overall docs go here...",
 *     url="http://swagger.io"
 * )
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     securityScheme="api_key",
 *     name="api_key"
 * )
 * @OA\Get(
 *     path="/version",
 *     summary="Get the API Version",
 *     operationId="apiVersion",
 *     @OA\Response(
 *         response=200,
 *         description="Valid response containing the API version"
 *     )
 * )
 */