<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

	protected $fillable = [
		'name',
		'description',
		'status',
	];

	public function employees(): HasMany
	{
		return $this->hasMany(Employee::class);
	}
}
