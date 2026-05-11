<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('units_opera', function (Blueprint $table) {
            $table->integer('new_status')->nullable()->default(null)->change();
            $table->decimal('new_price', 12, 2)->nullable()->default(null)->change();
        });
        DB::table('units_opera')->update(['status' => null, 'price' => null]);
    }
};
