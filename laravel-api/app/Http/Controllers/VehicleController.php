<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return response()->json($vehicles);
    }

    public function store(Request $request)
    {
        $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'color' => 'required|string|max:255',
        ]);

        $vehicle = Vehicle::create($request->all());

        return response()->json($vehicle, 201);
    }

    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return response()->json($vehicle);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'make' => 'string|max:255',
            'model' => 'string|max:255',
            'year' => 'string|max:4',
            'color' => 'string|max:255',
        ]);

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->all());

        return response()->json($vehicle);
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return response()->json(null, 204);
    }
}
