<?php
namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        return Trip::all();
    }

    public function store(Request $request)
    {
        $trip = Trip::create($request->all());
        return response()->json($trip, 201);
    }

    public function show($id)
    {
        return Trip::find($id);
    }

    public function update(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);
        $trip->update($request->all());
        return response()->json($trip, 200);
    }

    public function destroy($id)
    {
        Trip::find($id)->delete();
        return response()->json(null, 204);
    }
}
