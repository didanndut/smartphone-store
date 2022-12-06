<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smartphones', function (Blueprint $table) {
            $table->id();
            $table->integer('os_id')->nullable(false)->default(1);
            $table->integer('brand_id')->nullable(false)->default(1);
            $table->integer('manufacturer_id')->nullable(false)->default(1);
            $table->string('type')->nullable(false);
            $table->integer('price')->nullable(false);
            $table->integer('stock')->nullable(false);
            $table->softdeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('smartphones');
    }
};
