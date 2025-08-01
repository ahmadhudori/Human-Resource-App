<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HumanResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \faker\Factory::create();

		DB::table('departments')->insert([
			[
				'name' => 'HR',
				'description' => 'Department of Human Resource',
				'status' => 'active',
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
			],
			[
				'name' => 'IT',
				'description' => 'Department of Information Technology',
				'status' => 'active',
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
			],
			[
				'name' => 'Sales',
				'description' => 'Department of Sales',
				'status' => 'active',
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
			]
		]);

		DB::table('roles')->insert([
			[
				'title' => 'Human Resource',
				'description' => 'Handling team',
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
			],
			[
				'title' => 'Developer',
				'description' => 'Handling codes',
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
			],
			[
				'title' => 'Sales',
				'description' => 'Handling selling',
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
			],
		]);

		DB::table('employees')->insert([
			[
				'fullname' => $faker->name,
				'email' => $faker->unique()->safeEmail,
				'phone_number' => $faker->phoneNumber,
				'address' => $faker->address,
				'birth_date' => $faker->dateTimeBetween('-40 years', '-20 years'),
				'hire_date' => Carbon::now(),
				'department_id' => 1,
				'role_id' => 1,
				'status' => 'active',
				'salary' => $faker->randomFloat(2, 3000, 6000),
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
				'deleted_at' => null,
			],
			[
				'fullname' => $faker->name,
				'email' => $faker->unique()->safeEmail,
				'phone_number' => $faker->phoneNumber,
				'address' => $faker->address,
				'birth_date' => $faker->dateTimeBetween('-40 years', '-20 years'),
				'hire_date' => Carbon::now(),
				'department_id' => 2,
				'role_id' => 1,
				'status' => 'active',
				'salary' => $faker->randomFloat(2, 3000, 6000),
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
				'deleted_at' => null,
			],
		]);

		DB::table('tasks')->insert([
			[
				'title' => $faker->sentence(3),
				'description' => $faker->paragraph,
				'assigned_to' => 1,
				'due_date' => Carbon::parse('2025-02-15'),
				'status' => 'pending',
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
			],
			[
				'title' => $faker->sentence(3),
				'description' => $faker->paragraph,
				'assigned_to' => 2,
				'due_date' => Carbon::parse('2025-02-15'),
				'status' => 'pending',
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
			]
		]);

		DB::table('payroll')->insert([
			[
				'employee_id' => 1,
				'salary' => $faker->randomFloat(2, 3000, 6000),
				'bonuses' => $faker->randomFloat(2, 3000, 6000),
				'deductions' => $faker->randomFloat(2, 500, 1000),
				'net_salary' => $faker->randomFloat(2, 3000, 6000),
				'pay_date' => Carbon::parse('2025-02-15'),
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
			],
			[
				'employee_id' => 2,
				'salary' => $faker->randomFloat(2, 3000, 6000),
				'bonuses' => $faker->randomFloat(2, 3000, 6000),
				'deductions' => $faker->randomFloat(2, 500, 1000),
				'net_salary' => $faker->randomFloat(2, 3000, 6000),
				'pay_date' => Carbon::parse('2025-02-15'),
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
			]
		]);

		DB::table('presences')->insert([
			[
				'employee_id' => 1,
				'check_in' => Carbon::parse('2025-02-10 09:00:00'),
				'check_out' => Carbon::parse('2025-02-10 17:00:00'),
				'date' => Carbon::parse('2025-02-10'),
				'status' => 'present',
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
			],
			[
				'employee_id' => 2,
				'check_in' => Carbon::parse('2025-02-10 09:00:00'),
				'check_out' => Carbon::parse('2025-02-10 17:00:00'),
				'date' => Carbon::parse('2025-02-10'),
				'status' => 'present',
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
			]
		]);

		DB::table('leave_requests')->insert([
			[
				'employee_id' => 1,
				'leave_type' => 'sakit',
				'start_date' => Carbon::parse('2025-02-20'),
				'end_date' => Carbon::parse('2025-02-23'),
				'status' => 'pending',
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
			],
			[
				'employee_id' => 2,
				'leave_type' => 'sakit',
				'start_date' => Carbon::parse('2025-02-20'),
				'end_date' => Carbon::parse('2025-02-23'),
				'status' => 'pending',
				'created_at' => Carbon::now(),	
				'updated_at' => Carbon::now(),
			],
		]);
    }
}
