<?php
namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="Trip API", version="1.0")
 * @OA\Tag(name="Trip", description="API Endpoints for Trip Management")
 */
class TripController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/trips",
     *     summary="Get all trips",
     *     tags={"Trip"},
     *     @OA\Response(
     *         response=200,
     *         description="A list of trips",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Trip"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Trip::with('user')->get());
    }

    /**
     * @OA\Post(
     *     path="/api/trips",
     *     summary="Create a new trip",
     *     tags={"Trip"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TripRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Trip created",
     *         @OA\JsonContent(ref="#/components/schemas/Trip")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(type="object")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'starting_point' => 'required|string|max:255',
            'ending_point' => 'required|string|max:255',
            'starting_at' => 'required|date',
            'available_places' => 'required|integer|min:1',
            'price' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $trip = new Trip($request->all());
        $trip->user_id = $request->user()->id;
        $trip->save();

        return response()->json($trip, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/trips/{id}",
     *     summary="Get a trip by ID",
     *     tags={"Trip"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the trip to retrieve",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Trip retrieved",
     *         @OA\JsonContent(ref="#/components/schemas/Trip")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Trip not found",
     *         @OA\JsonContent(type="object")
     *     )
     * )
     */
    public function show($id)
    {
        $trip = Trip::with('user')->find($id);

        if (!$trip) {
            return response()->json(['message' => 'Trip not found'], 404);
        }

        return response()->json($trip);
    }

    /**
     * @OA\Put(
     *     path="/api/trips/{id}",
     *     summary="Update a trip",
     *     tags={"Trip"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the trip to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TripRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Trip updated",
     *         @OA\JsonContent(ref="#/components/schemas/Trip")
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized",
     *         @OA\JsonContent(type="object")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Trip not found",
     *         @OA\JsonContent(type="object")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(type="object")
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);

        if ($trip->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'starting_point' => 'sometimes|required|string|max:255',
            'ending_point' => 'sometimes|required|string|max:255',
            'starting_at' => 'sometimes|required|date',
            'available_places' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $trip->update($request->all());

        return response()->json($trip, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/trips/{id}",
     *     summary="Delete a trip",
     *     tags={"Trip"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the trip to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Trip deleted",
     *         @OA\JsonContent(type="object")
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized",
     *         @OA\JsonContent(type="object")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Trip not found",
     *         @OA\JsonContent(type="object")
     *     )
     * )
     */
    public function destroy(Request $request, $id)
    {
        $trip = Trip::find($id);

        if (!$trip) {
            return response()->json(['message' => 'Trip not found'], 404);
        }

        if ($trip->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $trip->delete();

        return response()->json(null, 204);
    }
}
