<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFilmsTableAddGenreRelation extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('films', function (Blueprint $table) {
            // Hapus kolom genre lama
            $table->dropColumn('genre');

            // Tambah genre_id sebagai foreign key
            $table->unsignedBigInteger('genre_id')->nullable();
            $table->foreign('genre_id')
                  ->references('id')
                  ->on('genres')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
            $table->dropColumn('genre_id');
            $table->string('genre')->nullable();
        });
    }
}
