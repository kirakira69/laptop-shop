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
    Schema::table('users', function (Blueprint $table) {
        // Personal Info
        $table->date('birthdate')->nullable();
        $table->string('phone')->nullable();
        
        // Address Components
        $table->string('zone')->nullable();
        $table->string('barangay')->nullable();
        $table->string('street')->nullable();
        $table->string('municipal')->nullable(); // City/Municipality
        $table->string('province')->nullable();
        $table->string('zip_code')->nullable();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
