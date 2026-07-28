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
    Schema::table('reviewers', function (Blueprint $table) {
        // We use JSON so a single file can be assigned to multiple sections at once
        $table->json('target_sections')->nullable()->after('category');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviewers', function (Blueprint $table) {
            //
        });
    }
};
