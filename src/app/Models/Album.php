<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rapper_id',
        'genre_id',
        'description',
        'price',
        'year',
        ];
        

public function rapper(): BelongsTo
{
 return $this->belongsTo(Rapper::class);
}

public function genre(): BelongsTo
{
 return $this->belongsTo(Genre::class);
}

public function jsonSerialize(): mixed
{
return [
'id' => intval($this->id),
'name' => $this->name,
'description' => $this->description,
'rapper' => $this->rapper->name,
'genre' => ($this->genre ? $this->genre->name : ''),
'price' => number_format($this->price, 2),
'year' => intval($this->year),
'image' => asset('images/' . $this->image),
];
}

}


