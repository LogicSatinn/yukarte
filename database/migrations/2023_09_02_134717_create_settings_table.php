<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->decimal('one_rep_max');
            $table->string('weight_unit');
            $table->integer('training_max_percentage');
            $table->json('main_lift_options');
            $table->json('template');

            $table->unsignedBigInteger('user_id');

            $table->index('user_id');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};