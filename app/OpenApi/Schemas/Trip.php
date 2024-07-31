<?php
namespace App\OpenApi\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Trip",
 *     type="object",
 *     title="Trip",
 *     required={"starting_point", "ending_point", "starting_at", "available_places", "price"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Trip ID"
 *     ),
 *     @OA\Property(
 *         property="starting_point",
 *         type="string",
 *         description="Starting point"
 *     ),
 *     @OA\Property(
 *         property="ending_point",
 *         type="string",
 *         description="Ending point"
 *     ),
 *     @OA\Property(
 *         property="starting_at",
 *         type="string",
 *         format="date",
 *         description="Starting date"
 *     ),
 *     @OA\Property(
 *         property="available_places",
 *         type="integer",
 *         description="Number of available places"
 *     ),
 *     @OA\Property(
 *         property="price",
 *         type="integer",
 *         description="Price of the trip"
 *     ),
 *     @OA\Property(
 *         property="user_id",
 *         type="integer",
 *         description="ID of the user who created the trip"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date",
 *         description="Creation date"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date",
 *         description="Last update date"
 *     )
 * )
 */
class Trip
{
}
