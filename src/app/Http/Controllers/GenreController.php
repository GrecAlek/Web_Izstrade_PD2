<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Genre;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Routing\Controllers\HasMiddleware;

class GenreController extends Controller
{

    public static function middleware(): array
{
return [
'auth',
];
}


    public function list(): View
{
$items = Genre::orderBy('name', 'asc')->get();
return view(
'genre.list',
[
'title' => 'Žanri',
'items' => $items,
]
);
}

// display new Genre form
public function create(): View
{
return view(
'genre.form',
[
'title' => 'Pievienot žanru'
'genre' => new Genre()
]
);
}

// create new Genre
public function put(Request $request): RedirectResponse
{
$validatedData = $request->validate([
'name' => 'required|string|max:255',
]);
$genre = new Genre();
$genre->name = $validatedData['name'];
$genre->save();
return redirect('/genres');
}


// display Genre editing form
public function update(Genre $genre): View
{
 return view(
 'genre.form',
 [
 'title' => 'Rediģēt žanru',
 'genre' => $genre
 ]
 );



}

public function patch(Genre $genre, Request $request): RedirectResponse
{
 $validatedData = $request->validate([
 'name' => 'required|string|max:255',
 ]);
 $genre->name = $validatedData['name'];
 $genre->save();
 return redirect('/genres');
}

public function delete(Genre $genre): RedirectResponse
{

 $genre->delete();
 return redirect('/genres');
}


}
