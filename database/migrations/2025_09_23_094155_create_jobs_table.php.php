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
        Schema::create('students', function (Blueprint $table) { 
            $table->id(); 
            $table->string('studentNumber', 9)->unique(); 
            $table->string('lname', 150); 
            $table->string('fname', 150); 
            $table->string('mi', 2); 
            $table->string('email', 150); 
            $table->string('contactNumber', 20); 
            $table->timestamps(); 
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
}; 
