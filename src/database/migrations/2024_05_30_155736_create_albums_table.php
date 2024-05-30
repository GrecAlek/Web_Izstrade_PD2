
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
 Schema::create('albums', function (Blueprint $table) {
$table->id();
$table->foreignId('rapper_id');
$table->foreignId('genre_id');
$table->string('name', 256);
$table->text('description')->nullable();
$table->decimal('price', 8, 2)->nullable();
$table->integer('year');
$table->string('image', 256)->nullable();
$table->boolean('display');
$table->timestamps();
$table->foreign('rapper_id')->references('id')->on('rappers');
$table->foreign('genre_id')->references('id')->on('genres');
 });
}

   
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};