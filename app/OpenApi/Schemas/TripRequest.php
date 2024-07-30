<?php
namespace App\OpenApi\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="TripRequest",
 *     type="object",
 *     title="TripRequest",
 *     required={"starting_point", "ending_point", "starting_at", "available_places", "price"},
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
 *         format="date-time",
 *         description="Starting date and time"
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
 *     )
 * )
 */
class TripRequest
{
}
