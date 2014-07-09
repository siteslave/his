<?php
/**
 * Class ServiceAccident
 *
 */

class ServiceAccident extends Eloquent
{
    protected $table = 'service_accidents';

    public static $roles = [
        'service_id'       => 'required',
        'accident_date'    => 'required',
        'accident_time'    => 'required',
        'accident_type_id' => 'required',
        'urgency'          => 'required'
    ];

    public function scopeGetDetail($query, $service_id)
    {
        return $query->select('service_accidents.*', 'at.th_name as accident_type_name', 'v.service_date')
            ->join('services as v', 'v.id', '=', 'service_accidents.service_id')
            ->leftJoin('accident_type as at', 'at.id', '=', 'service_accidents.accident_type_id')
            ->where('service_accidents.service_id', $service_id);
    }
}
