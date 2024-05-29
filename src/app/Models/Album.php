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
        'description',
        'price',
        'year',
        ];
        

public function rapper(): BelongsTo
{
 return $this->belongsTo(Rapper::class);
}

}


