<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reviewers', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    public function down()
    {
        Schema::table('reviewers', function (Blueprint $table) {
            $table->string('category')->nullable(); // Allows rollback if needed
        });
    }
};
