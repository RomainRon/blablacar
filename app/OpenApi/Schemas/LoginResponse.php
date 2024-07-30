<?php
namespace App\OpenApi\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="LoginResponse",
 *     type="object",
 *     title="LoginResponse",
 *     @OA\Property(
 *         property="token",
 *         type="string",
 *         description="Authentication token"
 *     )
 * )
 */
class LoginResponse
{
}
