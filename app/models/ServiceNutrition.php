<?php
/**
* ServiceNutrition
*/
class ServiceNutrition extends Eloquent
{
	protected $table = 'service_nutritions';
	public static $roles = [
		'service_id' => 'required|integer',
		'provider_id' => 'required|integer',
		'weight' => 'required|numeric',
		'height' => 'required|numeric',
		'child_develop' => 'required'
	];
}