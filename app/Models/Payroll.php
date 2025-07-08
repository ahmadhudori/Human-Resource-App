<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use SoftDeletes;

	protected $table = 'payroll';
	protected $fillable = [
		'employee_id',
		'salary',
		'bonuses',
		'deductions',
		'net_salary',
		'pay_date',
	];

	public function employee(): BelongsTo
	{
		return $this->belongsTo(Employee::class);
	}
}
