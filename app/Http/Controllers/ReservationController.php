<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Reservation;
use OpenApi\Annotations as OA;

class ReservationController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/reservation",
     *     summary="Create a reservation for a user",
     *     tags={"Reservations"},
     *     security={{"bearer":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Reservation details",
     *         @OA\JsonContent(
     *             required={"user_id", "trip_id"},
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="trip_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Reservation created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Reservation")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(type="object")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User not found",
     *         @OA\JsonContent(type="object", @OA\Property(property="message", type="string", example="User not found"))
     *     )
     * )
     */
    public function reservation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'trip_id' => 'required|integer|exists:trips,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $reservation = Reservation::create([
            'user_id' => $user->id,
            'trip_id' => $request->trip_id
        ]);

        return response()->json($reservation, 201);
    }
}
