<?php

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
        Schema::create('inheritances', function (Blueprint $table) {
            $table->id('inheritance_id');
            $table->string('inheritance_type', 100);
            $table->integer('inheritance_parent')->nullable()->default(0);
            $table->string('inheritance_title', 500);
            $table->text('inheritance_details')->nullable();
            $table->timestamp('inheritance_stamp')->nullable()->useCurrent();
            $table->string('inheritance_default', 5)->nullable()->default('yes');
            $table->integer('inheritance_flg')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inheritances');
    }
};
