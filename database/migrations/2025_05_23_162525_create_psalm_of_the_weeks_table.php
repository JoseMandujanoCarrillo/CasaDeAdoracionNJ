<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('psalm_of_the_weeks', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('book');
            $table->text('verses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psalm_of_the_weeks');
    }
};
