<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agama', function (Blueprint $table) {
            $table->id('agama_id');
            $table->string('name_agama');
        });

        // Insert data agama
        DB::table('agama')->insert([
            ['name_agama' => 'Islam'],
            ['name_agama' => 'Kristen'],
            ['name_agama' => 'Katolik'],
            ['name_agama' => 'Hindu'],
            ['name_agama' => 'Buddha'],
            ['name_agama' => 'Konghucu'],
        ]);
    }

    public function down(): void
    {
        // Drop the table if it exists
        Schema::dropIfExists('agama');
    }
};
