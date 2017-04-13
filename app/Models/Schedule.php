<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 08 Apr 2017 14:07:49 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Schedule
 * 
 * @property int $id
 * @property string $groups
 * @property \Carbon\Carbon $start_time
 * @property \Carbon\Carbon $end_time
 * @property string $day
 * @property int $cps_id
 * @property int $hall_id
 * @property int $lush_id
 * @property int $department_id
 * 
 * @property \App\Models\Cp $cp
 * @property \App\Models\Department $department
 * @property \App\Models\Hall $hall
 * @property \App\Models\Lush $lush
 *
 * @package App\Models
 */
class Schedule extends Eloquent
{
	protected $table = 'schedule';
	public $timestamps = false;

	protected $casts = [
		'cps_id' => 'int',
		'hall_id' => 'int',
		'lush_id' => 'int',
		'department_id' => 'int'
	];

	protected $dates = [
		'start_time',
		'end_time'
	];

	protected $fillable = [
		'groups',
		'start_time',
		'end_time',
		'day',
		'cps_id',
		'hall_id',
		'lush_id',
		'department_id'
	];

	public function cp()
	{
		return $this->belongsTo(\App\Models\Cp::class, 'cps_id');
	}

	public function department()
	{
		return $this->belongsTo(\App\Models\Department::class);
	}

	public function hall()
	{
		return $this->belongsTo(\App\Models\Hall::class);
	}

	public function lush()
	{
		return $this->belongsTo(\App\Models\Lush::class);
	}
}
