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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('User_id')->constrained()->onDelete('cascade');
            $table->string('Name');
            $table->dateTime('StartDate');
            $table->dateTime('EndDate')->nullable();
            $table->enum('Status', ['Active', 'Inactive']);
            $table->text('Participants');
            $table->unsignedBigInteger('Owner');
            $table->foreign('Owner')->references('id')->on('users'); 
            $table->text('Description')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
