<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('facility_material', function (Blueprint $table) {
            $table->unsignedBigInteger('facility_id');
            $table->unsignedBigInteger('material_id');
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
            $table->unique(['facility_id','material_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('facility_material');
    }
};
