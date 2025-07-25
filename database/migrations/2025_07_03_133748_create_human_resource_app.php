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
		// create table departments
		Schema::create('departments', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->text('description')->nullable();
			$table->string('status');
			$table->timestamps();
			$table->softDeletes();
		});

		// create table roles
		Schema::create('roles', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->text('description')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		
		// create table employees
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
			$table->string('fullname');
			$table->string('email')->unique();
			$table->string('phone_number');
			$table->text('address');
			$table->date('birth_date');
			$table->date('hire_date');
			$table->foreignId('department_id')->constrained('departments');
			$table->foreignId('role_id')->constrained('roles');
			$table->string('status');
			$table->decimal('salary', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });

		// create table tasks
		Schema::create('tasks', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->text('description')->nullable();
			$table->foreignId('assigned_to')->constrained('employees');
			$table->datetime('due_date');
			$table->string('status');
			$table->timestamps();
			$table->softDeletes();
		});

		// create table payroll
		Schema::create('payroll', function (Blueprint $table) {
			$table->id();
			$table->foreignId('employee_id')->constrained('employees');
			$table->decimal('salary', 10, 2);
			$table->decimal('bonuses', 10, 2)->nullable();
			$table->decimal('deductions', 10, 2)->nullable();
			$table->decimal('net_salary', 10, 2)->nullable();
			$table->date('pay_date');
			$table->timestamps();
			$table->softDeletes();
		});

		// create table presences
		Schema::create('presences', function (Blueprint $table) {
			$table->id();
			$table->foreignId('employee_id')->constrained('employees');
			$table->dateTime('check_in');
			$table->dateTime('check_out')->nullable();
			$table->date('date');
			$table->string('status');
			$table->timestamps();
			$table->softDeletes();
		});

		// create table leave requests
		Schema::create('leave_requests', function (Blueprint $table) {
			$table->id();
			$table->foreignId('employee_id')->constrained('employees');
			$table->string('leave_type');
			$table->date('start_date');
			$table->date('end_date');
			$table->string('status');
			$table->timestamps();
			$table->softDeletes();
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('payroll');
        Schema::dropIfExists('presences');
        Schema::dropIfExists('leave_requests');
    }
};
