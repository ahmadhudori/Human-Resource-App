<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveRequest extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
		'employee_id',
		'leave_type',
		'start_date',
		'end_date',
		'status',
	];

	public function employee(): BelongsTo
	{
		return $this->belongsTo(Employee::class);
	}
}
