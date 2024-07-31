<?php

namespace App\OpenApi\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Reservation",
 *     required={"user_id", "trip_id"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID of the reservation",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="user_id",
 *         type="integer",
 *         description="ID of the user",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="trip_id",
 *         type="integer",
 *         description="ID of the trip",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Creation timestamp",
 *         example="2024-07-31T12:34:56Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Update timestamp",
 *         example="2024-07-31T12:34:56Z"
 *     )
 * )
 */
class Reservation
{
}
