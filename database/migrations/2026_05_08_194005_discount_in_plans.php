<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('personal_plans', function (Blueprint $table) {
            $table->decimal('fill_discount_1', 12, 2)->default(0);
            $table->decimal('fill_discount_personalized', 12, 2)->default(0);
        });
    }
};
