<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use RuliLG\StableDiffusion\Models\StableDiffusionResult;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('writings', function (Blueprint $table) {
            $table->foreignIdFor(StableDiffusionResult::class)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('writings', function (Blueprint $table) {
            $table->dropForeignIdFor(StableDiffusionResult::class);
        });
    }
};
