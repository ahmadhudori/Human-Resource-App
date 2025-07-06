<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

	protected $fillable = [
		'fullname',
		'email',
		'phone_number',
		'address',
		'birth_date',
		'hire_date',
		'department_id',
		'role_id',
		'status',
		'salary',
	];

	public function tasks(): HasMany
	{
		return $this->hasMany(Task::class);
	}

	public function department(): BelongsTo
	{
		return $this->belongsTo(Department::class);
	}

	public function role(): BelongsTo
	{
		return $this->belongsTo(Role::class);
	}
}
