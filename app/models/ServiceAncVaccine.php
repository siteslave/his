<?php

/**
 * ServiceVaccineAnc
 */
class ServiceAncVaccine extends Eloquent
{

    protected $table = 'service_anc_vaccines';
    public static $roles = [
        'service_id' => 'required|integer',
        'vaccine_id' => 'required|integer',
        'provider_id' => 'required|integer',
        'lot' => 'required',
        'person_id' => 'required|integer',
        'gravida' => 'required'
    ];

    public function scopeIsDuplicate($query, $service_id = null, $vaccine_id = null)
    {
        return $query->where('service_id', '=', $service_id)
            ->where('vaccine_id', $vaccine_id);
    }
}
