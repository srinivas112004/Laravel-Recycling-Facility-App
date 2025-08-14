<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->date('last_update_date');
            $table->string('street_address');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('facilities');
    }
};
