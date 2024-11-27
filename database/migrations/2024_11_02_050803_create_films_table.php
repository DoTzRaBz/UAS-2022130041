<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('genre')->nullable();  // Hapus ->change()
            $table->string('director');
            $table->integer('release_year');
            $table->decimal('rating', 3, 1);
            $table->text('description');
            $table->integer('stock');
            $table->decimal('price', 10, 2);
            $table->decimal('rental_price', 10, 2);
            $table->string('poster')->nullable();  // Hapus method yang tidak valid
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('films', function (Blueprint $table) {
            $table->string('genre')->nullable(false)->change();
        });
    }
}
