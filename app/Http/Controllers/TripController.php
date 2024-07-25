<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TripController extends Controller
{
    public function index()
    {
        return response()->json(Trip::with('user')->get());
    }

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
        $trip->user_id = $request->user()->id; // Associer le trajet à l'utilisateur authentifié
        $trip->save();

        return response()->json($trip, 201);
    }

    public function show($id)
    {
        $trip = Trip::with('user')->find($id);

        if (!$trip) {
            return response()->json(['message' => 'Trip not found'], 404);
        }

        return response()->json($trip);
    }

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
