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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->nullable(false);
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2)->nullable(false);
            $table->integer('stock')->default(0)->nullable(false);
            $table->string('imagen')->nullable();
            $table->timestamps();
            
            $table->index('nombre');
            $table->index('stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
