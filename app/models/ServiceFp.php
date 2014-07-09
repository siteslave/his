<?php

/**
* ServiceFp
*/
class ServiceFp extends Eloquent
{
	protected $table = 'service_fp';
	public static $roles = [
		'fp_type_id' => 'required|integer',
		'service_id' => 'required|integer',
		'provider_id' => 'required|integer'
	];
	
	
	public function scopeIsDuplicate($query, $service_id, $fp_type_id)
	{
		return $query->where('service_id', '=', $service_id)
			->where('fp_type_id', '=', $fp_type_id);
	}
}