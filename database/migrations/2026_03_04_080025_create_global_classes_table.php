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
        Schema::create('global_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g. Form One
            $table->string('level'); // e.g. O-Level, A-Level
            $table->timestamps();
        });

        // Update school_classes to reference global_classes
        Schema::table('school_classes', function (Blueprint $table) {
            $table->unsignedBigInteger('global_class_id')->nullable()->after('id');
            $table->foreign('global_class_id')->references('id')->on('global_classes')->onDelete('cascade');
            $table->dropColumn(['name', 'level']); // Remove redundant columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_classes', function (Blueprint $table) {
            $table->dropForeign(['global_class_id']);
            $table->dropColumn('global_class_id');
            $table->string('name')->nullable();
            $table->string('level')->nullable();
        });
        Schema::dropIfExists('global_classes');
    }
};
