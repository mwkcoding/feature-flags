<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturesTable extends Migration
{
    public function up(): void
    {
        Schema::create('features', static function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->string('description');
            $table->boolean('is_enabled');
            $table->timestamps();

            $table->unique('slug');
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('features');
    }
}
