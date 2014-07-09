<?php

class ServiceVaccine extends Eloquent {

    protected $table = 'service_vaccines';
    public static $roles = [
        'service_id' => 'required|integer',
        'provider_id' => 'required|integer',
        'vaccine_id' => 'required|integer',
        'vaccine_place' => 'required|integer',
        'vaccine_lot' => 'required'
    ];

    public function scopeIsDuplicate($query, $service_id, $vaccine_id)
    {
        return $query->where('service_id', '=', $service_id)
            ->where('vaccine_id', '=', $vaccine_id);
    }
} 