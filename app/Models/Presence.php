<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presence extends Model
{
    use SoftDeletes;

	protected $fillable = [
		'employee_id',
		'check_in',
		'check_out',
		'date',
		'status'
	];

	public function employee(): BelongsTo
	{
		return $this->belongsTo(Employee::class);
	}
}
