<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('my_models', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->boolean('draft_is_valid')->default(false);
            $table->boolean('submit_is_valid')->default(false);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('my_models');
    }
};
