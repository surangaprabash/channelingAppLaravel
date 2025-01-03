<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Reference to users table
            $table->foreignId('department_id')->constrained()->onDelete('cascade'); // Reference to departments table
            $table->foreignId('doctor_id')->nullable()->constrained('users')->onDelete('cascade'); // Reference to users table (for doctors)
            $table->date('appointment_date');
            $table->string('appointment_status')->default('1');  // new appointment
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_appointments');
    }
};
