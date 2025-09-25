<?php

namespace App\Http\Controllers;
 /**
 * @OA\Info(
 *     title="My API Тестовая работа",
 *     version="1.0.0",
 *     description="API Documentation"
 * )
 *
 * @OA\Server(
 *     url="http://localhost/api",
 *     description="Local Server"
 * )
 * @OA\SecurityScheme(
 * securityScheme="bearerAuth",
 * type="http",
 * scheme="bearer",
 * bearerFormat="Personal Access Token",
 * description="Enter personal access token in format: Bearer {token}",
 * in="header"
 * )
 */
abstract class Controller
{
    //
}
