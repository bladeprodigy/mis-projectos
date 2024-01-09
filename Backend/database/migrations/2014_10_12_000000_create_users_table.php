<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
<<<<<<< HEAD

=======
    /**
     * Run the migrations.
     */
>>>>>>> parent of 6a5f8084 (Delete Backend directory in main zeby nie bylo konfliktow)
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
=======
            $table->string('username');
            $table->string('email')->unique();
>>>>>>> parent of 6a5f8084 (Delete Backend directory in main zeby nie bylo konfliktow)
            $table->string('password');
            $table->timestamps();
        });
    }

<<<<<<< HEAD
=======
    /**
     * Reverse the migrations.
     */
>>>>>>> parent of 6a5f8084 (Delete Backend directory in main zeby nie bylo konfliktow)
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
