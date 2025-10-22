<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Trainer;
use App\Models\SportType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Trainer::class)->constrained('trainers')->cascadeOnDelete();
            $table->foreignIdFor(SportType::class)->constrained('sport_types')->cascadeOnDelete();
            $table->string('name', 50);
            $table->text('description')->nullable();
            $table->integer('duration')->default(0);
            $table->decimal('price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
