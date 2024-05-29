<?php

namespace App\Http\Controllers;

use App\Models\Rapper;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;


class RapperController extends Controller implements HasMiddleware
{
    public function list(): View
    {
    $items = Rapper::orderBy('name', 'asc')->get();
    return view(
    'rapper.list',
    [
    'title' => 'Reperi',
    'items' => $items,
    ]
    );
    }

    public function create(): View
{
    
return view(
'rapper.form',
[
'title' => 'Pievienot reperi',
'rapper' => new Rapper()

]
);
}

public function put(Request $request): RedirectResponse
{
$validatedData = $request->validate([
'name' => 'required|string|max:255',
]);
$rapper = new Rapper();
$rapper->name = $validatedData['name'];
$rapper->save();
return redirect('/rappers');
}


public function update(Rapper $rapper): View
{
 return view(
 'rapper.form',
 [
 'title' => 'Rediģēt reperi',
 'rapper' => $rapper
 ]
 );
}

public function patch(Rapper $rapper, Request $request): RedirectResponse
{
 $validatedData = $request->validate([
 'name' => 'required|string|max:255',
 ]);
 $rapper->name = $validatedData['name'];
 $rapper->save();
 return redirect('/rappers');
}

public function delete(Rapper $rapper): RedirectResponse
{
 // šeit derētu pārbaude, kas neļauj dzēst autoru, ja tas piesaistīts eksistējošām grāmatām
 $rapper->delete();
 return redirect('/rappers');
}

public static function middleware(): array
{
return [
'auth',
];
}


}
