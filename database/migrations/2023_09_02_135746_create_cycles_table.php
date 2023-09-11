<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('cycles', function (Blueprint $table): void {
            $table->id();

            $table->date('start');
            $table->date('end');
            $table->decimal('training_max');
            $table->mediumText('notes')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cycles');
    }
};
