<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Models\Rapper;
use App\Models\Genre;
use App\Models\Album;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;

class AlbumController extends Controller implements HasMiddleware
{
    // Call auth middleware
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    // Display all Albums
    public function list(): View
    {
        $items = Album::orderBy('name', 'asc')->get();
        return view('album.list', [
            'title' => 'Albumi',
            'items' => $items
        ]);
    }

    // Validate and save Album data
    private function saveAlbumData(Album $album, AlbumRequest $request): void
    {
        $validatedData = $request->validated();
        $album->fill($validatedData);
        $album->display = (bool) ($validatedData['display'] ?? false);

        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $album->image = $uploadedFile->storePubliclyAs(
                '/',
                $name . '.' . $extension,
                'uploads'
            );
        }
        $album->save();
    }

    public function put(AlbumRequest $request): RedirectResponse
    {
        $album = new Album();
        $this->saveAlbumData($album, $request);
        return redirect('/albums');
    }

    public function patch(Album $album, AlbumRequest $request): RedirectResponse
    {
        $this->saveAlbumData($album, $request);
        return redirect('/albums/update/' . $album->id);
    }

    public function create(): View
    {
        $rappers = Rapper::orderBy('name', 'asc')->get();
        $genres = Genre::all(); 
        return view('album.form', [
            'title' => 'Pievienot albumu',
            'album' => new Album(),
            'rappers' => $rappers,
            'genres' => $genres,
        ]);
    }

    public function update(Album $album): View
    {
        $rappers = Rapper::orderBy('name', 'asc')->get();
        $genres = Genre::all(); 
        return view('album.form', [
            'title' => 'Rediģēt albumu',
            'album' => $album,
            'rappers' => $rappers,
            'genres' => $genres,
        ]);
    }

    public function delete(Album $album): RedirectResponse
    {
        if ($album->image) {
            unlink(getcwd() . '/images/' . $album->image);
        }
        $album->delete();
        return redirect('/albums');
    }
}
