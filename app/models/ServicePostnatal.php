<?php

class ServicePostnatal extends Eloquent {

    protected $table = 'service_postnatals';

    public static $roles = [
        'service_id' => 'required|integer',
        'person_id' => 'required|integer',
        'provider_id' => 'required|integer',
        'gravida' => 'required',
        'result' => 'required',
        'service_place' => 'required'
    ];
//
//    public function scopeIsDuplicate($query, $service_id, $person_id, $gravida) {
//        return $query->where('service_id', '=', $service_id)
//            ->where('person_id', '=', $person_id)
//            ->where('gravida', '=', $gravida);
//    }
}