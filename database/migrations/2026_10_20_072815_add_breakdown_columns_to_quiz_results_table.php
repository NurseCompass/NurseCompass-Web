<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('quiz_results', function (Blueprint $table) {
            $table->integer('academic_performance')->default(0)->after('total_questions');
            $table->integer('self_efficacy')->default(0)->after('academic_performance');
            $table->integer('initiative')->default(0)->after('self_efficacy');
            $table->integer('motivation')->default(0)->after('initiative');
            $table->string('top_category')->nullable()->after('motivation');
            $table->string('prediction')->nullable()->after('top_category');
            $table->text('personalized_note')->nullable()->after('prediction');
        });
    }

    public function down(): void
    {
        Schema::table('quiz_results', function (Blueprint $table) {
            $table->dropColumn([
                'academic_performance',
                'self_efficacy',
                'initiative',
                'motivation',
                'top_category',
                'prediction',
                'personalized_note'
            ]);
        });
    }
};
