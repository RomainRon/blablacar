<?php

namespace App\OpenApi\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User",
 *     required={"firstname", "lastname", "email"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="User ID"
 *     ),
 *     @OA\Property(
 *         property="firstname",
 *         type="string",
 *         description="First name"
 *     ),
 *     @OA\Property(
 *         property="lastname",
 *         type="string",
 *         description="Last name"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         description="Email address"
 *     ),
 *     @OA\Property(
 *         property="password",
 *         type="string",
 *         description="Password"
 *     ),
 *     @OA\Property(
 *         property="avatar",
 *         type="string",
 *         description="Avatar URL"
 *     ),
 *     @OA\Property(
 *         property="role",
 *         type="string",
 *         description="User role"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Creation timestamp"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Last update timestamp"
 *     )
 * )
 */
class User
{
}
