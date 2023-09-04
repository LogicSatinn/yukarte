<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('weeks', function (Blueprint $table) {
            $table->id();

            $table->string('type');
            $table->date('start');
            $table->date('end');
            $table->mediumText('notes')->nullable();

            $table->unsignedBigInteger('cycle_id');
            $table->index('cycle_id');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weeks');
    }
};
