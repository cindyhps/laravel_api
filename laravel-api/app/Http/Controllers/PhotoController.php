<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // maksimal 2MB
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $path = $photo->store('photos', 'public'); // penyimpanan di folder 'public/photos'

            return response()->json([
                'message' => 'File uploaded successfully',
                'path' => $path,
            ], 201);
        } else {
            return response()->json([
                'message' => 'File not found in request',
            ], 400);
        }
    }


    public function show($filename)
    {
        // Pastikan file tersedia di storage
        if (!Storage::disk('public')->exists($filename)) {
            return response()->json(['message' => 'File not found'], 404);
        }

        // Ambil file dari storage dan kirimkan sebagai response
        $file = Storage::disk('public')->get($filename);
        $type = Storage::disk('public')->mimeType($filename);

        return response($file, 200)
            ->header('Content-Type', $type);
    }
}

