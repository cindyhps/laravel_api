<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    public function index()
    {
        $inventoryItems = InventoryItem::all();
        return response()->json($inventoryItems);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $inventoryItem = InventoryItem::create($request->all());

        return response()->json($inventoryItem, 201);
    }

    public function show($id)
    {
        $inventoryItem = InventoryItem::findOrFail($id);
        return response()->json($inventoryItem);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'integer|min:0',
            'price' => 'numeric|min:0',
        ]);

        $inventoryItem = InventoryItem::findOrFail($id);
        $inventoryItem->update($request->all());

        return response()->json($inventoryItem);
    }

    public function destroy($id)
    {
        $inventoryItem = InventoryItem::findOrFail($id);
        $inventoryItem->delete();

        return response()->json(null, 204);
    }
}
