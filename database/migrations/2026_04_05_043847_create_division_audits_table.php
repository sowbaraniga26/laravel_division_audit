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
        Schema::create('divison_audits', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('reason_id');
            
            $table->date('audit_date');
            $table->string('status')->nullable(); // OK / NOT OK
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('division_audits');
    }
};
