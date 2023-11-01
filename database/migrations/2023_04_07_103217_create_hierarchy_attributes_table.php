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
        Schema::create('hierarchy_attributes', function (Blueprint $table) {
            $table->id();
            // Create hierarchy_id reference Foreign Key hierarchies.id
            $table->bigInteger('hierarchy_id')->unsigned();
            // $table->foreignId('hierarchy_id')->constrained('hierarchies')->onDelete('cascade');
            $table->string('name', 500);
            $table->text('value')->nullable();
            $table->integer('flag')->default(1);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->foreign('hierarchy_id')->references('id')->on('hierarchies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hierarchy_attributes');
    }
};
