<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->foreignId('rental_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('status', ['ongoing', 'paid'])->default('ongoing');
        });
    }

    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['rental_id']);
            $table->dropColumn(['rental_id', 'status']);
        });
    }
};
