<?php

class ServiceAnc extends Eloquent {
    protected $table = 'service_anc';

    public static $roles = [
        'ga' => 'required|integer',
        'gravida' => 'required|integer',
        'anc_result' => 'required|integer',
        'service_id' => 'required|integer',
        'person_id' => 'required|integer'
    ];
} 