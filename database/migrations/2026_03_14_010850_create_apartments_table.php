<?php

declare(strict_types=1);

use App\Models\Condominium;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();   
            $table->foreignIdFor(Condominium::class)->constrained()->cascadeOnDelete();
            $table->string('block')->nullable();
            $table->string('number');
            $table->unsignedInteger('parking_spot_limit')->default(1);
            $table->unique(['condominium_id', 'block', 'number']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
