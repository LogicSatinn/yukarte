<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('days', function (Blueprint $table) {
            $table->id();

            $table->dateTime('date');
            $table->json('assistance_work');
            $table->json('personal_record');

            $table->unsignedBigInteger('week_id');
            $table->index('week_id');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('days');
    }
};