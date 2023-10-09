<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('weeks', function (Blueprint $table): void {
            $table->id();

            $table->tinyInteger('number');
            $table->date('start');
            $table->date('end');
            $table->mediumText('notes')->nullable();

            $table->unsignedBigInteger('cycle_id');
            $table->index('cycle_id');

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weeks');
    }
};
