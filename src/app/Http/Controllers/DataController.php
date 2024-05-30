<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Http\JsonResponse;

class DataController extends Controller
{

    // Return 3 published Albums in random order
public function getTopAlbums(): JsonResponse
{
$albums = Album::where('display', true)
->inRandomOrder()
->take(3)
->get();
return response()->json($albums);
}
// Return selected Album if it's published
public function getAlbum(Album $album): JsonResponse
{
$selectedAlbum = Album::where([
'id' => $album->id,
'display' => true,
])
->firstOrFail();
return response()->json($selectedAlbum);
}
// Return 3 published Albums in random order- except the selected Album
public function getRelatedAlbums(Album $album): JsonResponse
{
$albums = Album::where('display', true)
->where('id', '<>', $album->id)
->inRandomOrder()
->take(3)
->get();
return response()->json($albums);
}

}
