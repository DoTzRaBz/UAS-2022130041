<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalsTable extends Migration
{
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->foreignId('film_id')->constrained()->onDelete('cascade');
            $table->date('rental_date');
            $table->date('return_date');
            $table->date('actual_return_date')->nullable();
            $table->decimal('rental_fee', 10, 2)->default(0); // Tambahkan default value
            $table->decimal('late_fee', 10, 2)->nullable();
            $table->enum('status', ['ongoing', 'returned', 'overdue'])->default('ongoing');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rentals');
    }
}
